function init () {
	var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	var $route = document.querySelector("[name=route]").value;
var vm = new Vue({
	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el: '#UserController',

	data: {
		newUser: {
			id: '1',
			name: 'Mundo',
			email: 'gilbal@hotmail.com',
			address: 'cacalchen'
		},

		success: false,

		edit: false
	},

	methods: {

		fetchUser: function () {
			this.$http.get($route + '/api/users', function (data) {
				console.log(data);
				this.$set('users', data);
			})
		},

		RemoveUser: function (id) {
			var ConfirmBox = confirm("Are you sure, you want to delete this User?")

			if(ConfirmBox) this.$http.delete($route + '/api/users/' + id)

			this.fetchUser()
		},

		EditUser: function (id) {
			var user = this.newUser

			this.newUser = { id: '', name: '', email: '', address: ''}

			this.$http.patch($route + '/api/users' + id, user, function (data) {
				console.log(data)
			})

			this.fetchUser()

			this.edit = false

		},

		ShowUser: function (id) {
			this.edit = true

			this.$http.get($route + '/api/users/' + id, function (data) {
				this.newUser.id = data.id
				this.newUser.name = data.name
				this.newUser.email = data.email
				this.newUser.address = data.address
			})
		},

		AddNewUser: function () {
			// User input
			var user = this.newUser

			// Clear form input
			this.newUser = { name:'', email:'', address:'' }

			// Send post request
			this.$http.post($route + '/api/users', user)

			// Show success message
			self = this
			this.success = true
			setTimeout(function () {
				self.success = false
			}, 5000)

			// Reload page
			this.fetchUser()

		}

	},

	computed: {
		validation: function () {
			return {
				name: !!this.newUser.name.trim(),
				email: emailRE.test(this.newUser.email),
				address: !!this.newUser.address.trim()
			}
		},

		isValid: function () {
			var validation = this.validation
			return Object.keys(validation).every(function (key) {
				return validation[key]
			})
		}
	},

	ready: function () {
		this.fetchUser()
	}
});
}

window.onload = init;

<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="token" id="token" value="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/vue.js"></script>
    <script src="js/vue-resource.js"></script>
  </head>
  <body>
    
    <!-- INICIO DEL VUE -->
    <div id="autos" class="container">
      
      <button class="btn btn-primary" v-on:click="editando=true">Agregar auto</button><br><br>
      <div class="row" v-if="editando==true">
        <div class="col-xs-6">
            <input type="text" placeholder="Escriba la placa" v-model="placa" class="form-control"><br>

            <input type="text" placeholder="Escriba el modelo" class="form-control" v-model="modelo"><br>

            <input type="number" class="form-control" v-model="precio"><br> 

            <button class="btn btn-success" v-on:click="updateAuto(placa)">Guardar</button>
            <button class="btn btn-warning" v-on:click="editando=false">Cancelar</button>         

        </div>
      </div>

        
      <div class="row">
        <div class="col-md-6">
            <table class="table">
                <thead>
                  <th>PLACA</th>
                  <th>MODELO</th>
                  <th>PRECIO</th>
                  <th>OPCIONES</th>
                </thead>

                <tbody>
                    <tr v-for="auto in autos">
                        <td>@{{auto.placa}}</td>
                        <td>@{{auto.modelo}}</td>
                        <td>@{{auto.precio}}</td>
                        <td>
                            <span class="glyphicon glyphicon-pencil btn btn-xs" v-on:click="showAuto(auto.placa)"></span>

                            <span class="glyphicon glyphicon-trash btn btn-xs btn-danger" v-on:click="eliminarAuto(auto.placa)"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>

        
    </div>
    <!-- FIN  DEL VUE -->



    <script src="js/autos.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
@extends('layouts.adminlte')
@section('contenido')

<div id="tutoria_individual"> 
	<busqueda></busqueda>
</div>


@endsection

@push('scripts')
	{{-- <script src="{{asset('adminlte/js/adminlte.min.js')}}"></script> --}}
	<script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/api/tutoria/tutoria_individual.js')}}"></script>
@endpush
<input type="hidden" name="route" value="{{url('/')}}">
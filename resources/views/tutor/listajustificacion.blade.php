@extends('layouts.adminlte')
@section('contenido')
<div class="box">
  <div class="row">
    <div class="col-md-10">
        <table class="table table-bordered table-hover table-responsive">
           <thead>
             <th>FOLIO</th>
             <th>MATRICULA</th>
             <th>ALUMNO</th>
             <th>F. SOLICITUD</th>
             <th>MOTIVO</th>
             <th></th>
          </thead>

          <tbody>
            @foreach($justificaciones as $justi)
            <tr>
                <td>{{$justi->folio}}</td>
                <td>{{$justi->matricula}}</td>
                <td>{{$justi->alumno->apellidop}} {{$justi->alumno->apellidom}} {{$justi->alumno->nombre}}</td>
                <td>{{$justi->fecha_solicitud->format('d/m/Y')}}</td>
                <td>{{$justi->motivo->motivo}}</td>
                <td>
                  <a href="{{route('imprimir',$justi->folio)}} " target="_blank">
                    <span class="glyphicon glyphicon-print"></span>
                  </a>
                </td>

            </tr>
            @endforeach

          </tbody>
        </table>
    </div>
  </div>
</div>
 








@endsection


@push('scripts')
	{{-- <script src="{{asset('adminlte/js/adminlte.min.js')}}"></script> --}}
	{{-- <script src="{{asset('js/vue-resource.min.js')}}"></script>
	<script src="{{asset('js/avance.js')}}"></script> --}}
@endpush
<input type="hidden" name="route" value="{{url('/')}}">


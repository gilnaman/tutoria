@extends('layouts.adminprofe')
@section('contenido')
	<div class="box box-info">
		<div id="cargasPondera">
		

		<div class="row">
			<br>
			<div class="col-md-10">
				
				<table class="table table-bordered">
					<thead>
						<th>Grupo</th>
						<th>Clave</th>
						<th>Asignatura</th>
						
						<th><span class="glyphicon glyphicon-print"></span></th>
					</thead>

					<tbody>
						@foreach($cargas as $carga)
							<td>{{$carga->ClaveGrupo}}</td>
							<td>{{$carga->ClaveAsig}}</td>
							<td>{{$carga->Asignatura}}</td>
							<td>
								<div class="btn-group">
  									<button type="button" class="btn btn-default dropdown-toggle"
          							data-toggle="dropdown">

          							Listas 
          							<span class="caret"></span>
  								</button>

							  <ul class="dropdown-menu" role="menu">
							  	{{-- <a href="{{url('anexaradultos', ['idguest' => $idguest->id, 'idbook' => $idbook->id, 'idroom' => $idroom->id])}}">Agregar adultos</a> --}}
									
							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>1])}}" target="_blank">
							    	Unidad 1
									</a>
							    </li>
							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>2])}}" target="_blank">
							    	Unidad 2
									</a>
							    </li>
							    
							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>3])}}" target="_blank">
							    	Unidad 3
									</a>
							    </li>
							    
							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>4])}}" target="_blank">
							    	Unidad 4
									</a>
							    </li>

							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>5])}}" target="_blank">
							    	Unidad 5
									</a>
							    </li>

							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>6])}}" target="_blank">
							    	Unidad 6
									</a>
							    </li>

							    <li>
							    	<a href="{{url('listar',['claveasig'=>$carga->ClaveAsig,'clavegrupo'=>$carga->ClaveGrupo,'unidad'=>7])}}" target="_blank">
							    	Unidad 7
									</a>
							    </li>

							  </ul>
							</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			
		</div>
		</div>
	</div>

@endsection

@push('scripts')
	
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">
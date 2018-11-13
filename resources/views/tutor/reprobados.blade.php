@extends('layouts.adminlte')
@section('contenido')
	<div class="box">
            <div class="box-header">
              <h3 class="box-title">Reprobados por unidad</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed table-bordered table-hover" >
                <tr>
                  <th style="width: 10px">Matricula</th>
                  <th style="width: 60px">Alumno </th>
                  <th style="width: 40px">U1</th>
                  <th style="width: 40px">U2</th>
                  <th style="width: 40px">U3</th>
                  <th style="width: 40px">U4</th>
                  <th style="width: 40px">U5</th>
                  <th style="width: 40px">U6</th>
                </tr>

                @foreach($reprobados as $reprobado)
                <tr>
                  <td><b>{{$reprobado->matricula}}</b></td>
                  <td><b>{{$reprobado->alumno}}</b></td>
                  <td>
                  	@if($reprobado->u1!=0)
                  	<b class="btn btn-danger btn-xs">{{$reprobado->u1}}</b>
                  	@else
                  		{{$reprobado->u1}}
                  	@endif	

                  </td>
                  
                   <td>
                  	@if($reprobado->u2!=0)
                  	<b class="btn btn-danger btn-xs">{{$reprobado->u2}}</b>
                  	@else
                  		{{$reprobado->u2}}
                  	@endif	

                  </td>

                   <td>
                  	@if($reprobado->u3!=0)
                  	<b class="btn btn-danger btn-xs">{{$reprobado->u3}}</b>
                  	@else
                  		{{$reprobado->u3}}
                  	@endif	

                  </td>
                  
                   <td>
                  	@if($reprobado->u4!=0)
                  	<b class="btn btn-danger btn-xs">{{$reprobado->u4}}</b>
                  	@else
                  		{{$reprobado->u4}}
                  	@endif	

                  </td>

                  <td>{{$reprobado->u5}}</td>
                  <td>{{$reprobado->u6}}</td>
    		
				</tr>
				@endforeach
					
				<tr>
					<td></td>
					<td><h3>TOTALES</h3></td>
				
				<td><h3>{{$totales[0]}}</h3></td>
				<td><h3>{{$totales[1]}}</h3></td>
				<td><h3>{{$totales[2]}}</h3></td>
				<td><h3>{{$totales[3]}}</h3></td>
				<td><h3>{{$totales[4]}}</h3></td>
				<td><h3>{{$totales[5]}}</h3></td>


				{{--<td class="btn btn-danger"><h4>{{$totales[1]}}</h4></td>
				<td class="btn btn-danger"><h4>{{$totales[2]}}</h4></td>
				--}}

				</tr>
			</table>

    		</div>

                
                
                
    </div>
              
    
@endsection()
@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        @if (Auth::user()->admin)
          @include('layouts.admins.edit-delete-buttons', [
            'resource' => 'institutes',
            'id' => $institute->id
          ])
        @endif

        <h1>
          {{ $institute->name }}
        </h1>

        @if ($institute->leader())
          <h2>
            Encargado:
            {{
            link_to_route(
              'users.show',
              $institute->leader()->personalDetails->formattedNames(),
              $institute->leader()->personalDetails->user->id
              )
            }}
            {!! Html::mailto($institute->leader()->personalDetails->user->email) !!}

            <br>

            {{ $institute->leader()->pivot->position }}
          </h2>

            @if (Auth::user()->admin)
              {!!
              link_to_route(
                'institutesProfessors.createLeadFromInstToProf',
                'Cambiar Líder de la institución',
                $institute->id,
                ['class' => 'btn btn-default']
              )
              !!}
            @endif
        @else
            @if (Auth::user()->admin)
              {!!
              link_to_route(
                'institutesProfessors.createLeadFromInstToProf',
                'Asignar Líder de la institución',
                $institute->id,
                ['class' => 'btn btn-default']
              )
              !!}
            @endif
        @endif

          @if (Auth::user()->admin)
            {!!
            link_to_route(
              'institutesProfessors.createNoLeadFromInstToProf',
              'Añadir profesor a la institución',
              $institute->id,
              ['class' => 'btn btn-default']
            )
            !!}
          @endif
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <h2>Profesores relacionados</h2>
        <table
          id="tabla"
          data-toggle="table"
          data-search="true"
          data-pagination="true"
          data-page-list="[10, 25, 50, 100]"
          data-show-toggle="true"
          data-show-columns="true"
          data-click-to-select="true"
          data-maintain-selected="true"
          data-sort-name="first_name"
        >
          <thead>
          <th data-field="operate" data-formatter="operateFormatter"
              data-events="operateEvents">Ver
          </th>
          <th data-field="resource" data-sortable="true" data-switchable="true">
            Seudónimo
          </th>
          <th data-field="email" data-sortable="true" data-switchable="true">
            Correo Electrónico
          </th>
          <th data-field="first_name" data-sortable="true"
              data-switchable="false">
            Primer Nombre
          </th>
          <th data-field="first_surname" data-sortable="true"
              data-switchable="false">
            Primer Apellido
          </th>
          <th data-field="title" data-sortable="true"
              data-switchable="false">
            Título
          </th>
          @if (Auth::user()->admin)
            <th data-field="actions" data-sortable="false"
                data-switchable="true">
              Acciones
            </th>
          @endif
          </thead>
          <tbody>
          @foreach ($institute->professors as $professor)
            <tr>
              <td></td>
              <td>{{ $professor->personalDetails->user->name }}</td>
              <td>{{ $professor->personalDetails->user->email }}</td>
              <td>{{ $professor->personalDetails->first_name }}</td>
              <td>{{ $professor->personalDetails->first_surname }}</td>
              <td>{{ $professor->title->desc }}</td>
              @if (Auth::user()->admin)
                <td>
                  <a href="#" title="Eliminar" class="professor-action-delete"
                     data-id="{{ $professor->id }}">
                    <i class="fa fa-times text-danger"></i>
                  </a>
                  {!! Form::open(['route' => ['institutesProfessors.destroyProfInst', $professor->id, $institute->id], 'method' => 'DELETE', 'id' => "professor-delete-$professor->id"]) !!}
                  {!! Form::close() !!}
                </td>
              @endif
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <hr>

    <div class="row">
      <div class="col-sm-12">
        <h2>Eventos relacionados</h2>
        <table
          id="tabla"
          data-toggle="table"
          data-search="true"
          data-pagination="true"
          data-page-list="[10, 25, 50, 100]"
          data-show-toggle="true"
          data-show-columns="true"
          data-click-to-select="true"
          data-maintain-selected="true"
          data-sort-name="first_name"
        >
          <thead>
          <th data-field="name" data-sortable="true" data-switchable="true">
            Nombre
          </th>
          <th data-field="hours" data-sortable="true" data-switchable="true">
            Horas
          </th>
          <th data-field="date" data-sortable="true" data-switchable="true">
            Fecha
          </th>
          </thead>
          <tbody>
          @foreach ($institute->events as $event)
            <tr>
              <td>
                {{ link_to_route('events.show', $event->name, $event->id) }}
              </td>
              <td>
                {{ $event->hours }}
              </td>
              <td>
                {{ Date::parse($event->date)->format('l j F \d\e Y') }}.
                {{ Date::parse($event->date)->diffForHumans() }}.
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@stop

@section('css')
  <link rel="stylesheet" type="text/css"
        href="{!! asset('css/bootstrap-table.css') !!}">
@stop

@section('js')
  <script src="{!! asset('js/bootstrap-table.js') !!}"></script>
  <script src="{!! asset('js/bootstrap-table-es-CR.js') !!}"></script>
  <script src="{!! asset('js/initBootstrapTable.js') !!}"></script>
  <script type="text/javascript">
    initBootstrapTable("{!! route('users.show', 'no-data') !!}")
  </script>
  <script>
    $('document').ready(function () {
      $('.professor-action-delete').click(function () {
        var id = $(this).data('id');

        $('#professor-delete-' + id).submit();
      });
    });
  </script>
@stop
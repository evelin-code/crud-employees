@extends('./../template')

@section('content')
    <h1 class="text-center">Empleados</h1>
    <div class="d-flex flex-row-reverse m-2">
        <a href=" {{ route('create.employee') }} " class="btn btn-action-create btn-sm"><i class="fas fa-plus"></i>&nbsp;CREAR</a>
    </div>
    <div class="card rounded-0 mt-4">
        <div class="card-body">
            <div class="scrolllable">
                <table class="table table-striped m-1" style="white-space: nowrap; overflow-x: auto;">
                    <thead>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Género</th>
                        <th>Área</th>
                        <th>Boletín</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </thead>
                    <tbody>
                        @foreach ($employees as $row)
                            <tr>
                                <td> {{ $row->nombre }} </td>
                                <td> {{ $row->email }} </td>
                                <td> {{ $row->sexo }} </td>
                                <td> {{ $row->nombrearea }} </td>
                                <td> {{ $row->boletin }} </td>
                                <td class="text-rigth">
                                    <a href=" {{ route('edit.employee', $row->id) }} " class="btn btn-action-edit btn-sm"><i
                                            class="fas fa-pen"></i>&nbsp;
                                    </a>&nbsp;
                                </td>
                                <td class="text-rigth">
                                    <form action="{{ route('delete.employee', $row->id) }}" method="POST"
                                        style="display: inline-block;" id="form-delete" class="form-delete btn-form-delete">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-action-delete btn-sm"><i
                                                class="fa fa-trash"></i>&nbsp;</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @if (session('guardar') == 'ok')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Guardado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error') == 'no')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'No se guardo correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('actualizar') == 'ok')
        <script>
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Actualizado correctamente',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'Eliminado correctamente',
                'success'
            )
        </script>
    @endif

    <script type="text/javascript">
        $('#form-delete').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Está seguro?',
                text: "¡No podrá revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#21211d',
                cancelButtonColor: '#9b9b9b',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        })
    </script>
@endsection

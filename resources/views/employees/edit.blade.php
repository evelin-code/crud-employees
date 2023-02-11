@extends('./../template')

@section('back')
    <div class="m-5">
        <a role="button" href="{{ route('index.employee') }}" class="btn-back"><img src="{{ asset('images/back.png') }}"
                class="btn-back" alt="Atrás"></a>
    </div>
@endsection

@section('content')
    <h1 class="text-center">Editar Empleado</h1>
    <div class="container mb-5">
        <div class="card rounded-0 mt-4">
            <div class="card-body">
                <h6 class="required-text">Los campos marcados con asteriscos (*) son obligatorios</h6>
                <form method="POST" class="row g-3 mt-1" action="{{ route('update.employee', $data) }}">
                    @csrf()
                    @method('put')
                    <div class="col-md-6 mt-3">
                        <label for="name">Nombre Completo *</label>
                        <input type="text" class="form-control input-form" id="name" name="name"
                            value="{{ old('name', $data->nombre) }}">
                        @error('name')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label class="" for="email">Correo electrónico *</label>
                        <input type="text" class="form-control input-form" id="email" name="email"
                            value="{{ old('email', $data->email) }}">
                        @error('email')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="">Área *</label>
                        <select class="form-select" aria-label="" id="area" name="area">
                            <option value="">Seleccione:</option>
                            @foreach ($areas as $row)
                                <option value="{{ old('area', $row->id) }}"
                                    {{ $row->id == $data->area_id ? 'selected' : '' }}>
                                    {{ $row->nombre }}</option>;
                            @endforeach
                        </select>
                        @error('area')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="" for="description">Descripción de la experiencia del empleado *</label>
                        <textarea class="form-control" id="description" name="description" rows="7">{{ old('description', $data->descripcion) }}</textarea>
                        @error('description')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="roles">Roles *</label>
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" id="role{{ $role->id }}"
                                    value="{{ $role->id }}"
                                    {{ in_array($role->id, old('roles', $data->roles->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label " for="role{{ $role->id }}">{{ $role->nombre }}</label>
                            </div>
                        @endforeach
                        @error('roles')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <label class="" for="gender">Género *</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="M"
                                {{ old('gender', $data->sexo) == 'M' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender1">Masculino</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="F"
                                {{ old('gender', $data->sexo) == 'F' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender2">Femenino</label>
                        </div>
                        @error('gender')
                            <small class="ms-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-12 mt-3">
                        <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter"
                            {{ old('newsletter', $data->boletin) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label " for="newsletter">¿Desea recibir el boletín informativo?</label>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn-create">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        Editar mi imagen
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{route('image.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}" >
                            <div class="form-group row">
                                <label for="image_path" class="col-md-3 col-form-label text-md-right">Imagen</label>

                                <div class="col-md-7">
                                    @if ($image->user->image)
                                        <div class="container-avatar">
                                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="avatar" />
                                        </div>
                                    @endif
                                    <input type="file" name="image_path" id="image_path"
                                        class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}">

                                    @if ($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path') }}</strong>
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcion" class="col-md-3 col-form-label text-md-right">descripcion</label>

                                <div class="col-md-7">
                                    <textarea name="descripcion" id="descripcion" class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                        required>{{ $image->descripcion }}</textarea>
                                </div>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <input type="submit" value="Actualizar Imagen" class="btn btn-primary"
                                        alt="Boton para subir imagen">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

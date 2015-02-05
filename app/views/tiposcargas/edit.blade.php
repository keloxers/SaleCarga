@extends('layouts.default')

@section('content')


        <div class="container">

          <div class="row">
            <div class="col-md-6">

              <h2 class="short"><strong>Editar</strong> Categoria</h2>
              {{ Form::open(array('url' => URL::to('/categorias/' . $categoria->id), 'method' => 'PUT', 'class' => 'panel-body wrapper-lg')) }}


              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Categoria</label>
                    <input type="text" value="{{$categoria->categoria}}" data-msg-required="Ingrese categoria" maxlength="100" class="form-control" name="categoria" id="categoria">
                    @if ($errors->first('categoria'))
                        <span class="label label-warning">{{ $errors->first('categoria') }}</span>
                    @endif

                  </div>
                </div>
              </div>




              <div class="row">
                <div class="col-md-12">
                  <input type="submit" value="Grabar" class="btn btn-primary btn-lg" data-loading-text="Loading...">
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">

          </div>

        </div>

      </div>

    </div>







@stop

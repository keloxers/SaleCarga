@extends('layouts.default')

@section('content')


        <div class="container">

          <div class="row">
            <div class="col-md-6">

              <h2 class="short"><strong>Editar</strong> producto</h2>
              {{ Form::open(array('url' => URL::to('/productos/' . $producto->id), 'method' => 'PUT', 'class' => 'panel-body wrapper-lg')) }}

              <div class="row">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>Tipo</label>
                    {{ Form::select('tipo', array('principal' => 'Principal', 'secundaria' => 'Secundaria', 'normal' => 'Normal'), $producto->tipo, array('class' => 'form-control input-lg', 'id' =>'tipo')) }}
                  </div>
                  <div class="col-md-6">
                    <label>Categoria</label>
                    {{ Form::select( 'categorias_id', Categoria::All()->
                    lists('categoria', 'id'), $producto->categorias_id, array( "placeholder" => "", 'class' => 'form-control input-lg')) }}
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Producto</label>
                    <input type="text" value="{{$producto->producto}}" data-msg-required="Ingrese producto" maxlength="100" class="form-control" name="producto" id="producto">
                    @if ($errors->first('producto'))
                        <span class="label label-warning">{{ $errors->first('producto') }}</span>
                    @endif

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Texto</label>
                    <textarea maxlength="2000" data-msg-required="Please enter your message." rows="3" class="form-control" name="texto" id="texto">{{$producto->texto}}</textarea>
                    @if ($errors->first('texto'))
                    <span class="label label-warning">{{ $errors->first('texto') }}</span>
                    @endif

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Descripcion *</label>
                    <textarea maxlength="2000" data-msg-required="Please enter your message." rows="10" class="form-control" name="descripcion" id="descripcion">{{$producto->descripcion}}</textarea>
                    @if ($errors->first('descripcion'))
                    <span class="label label-warning">{{ $errors->first('descripcion') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group">
                  <div class="col-md-6">
                    <label>Precio Anterior</label>
                    <input type="text" value="{{$producto->precio_anterior}}" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="precio_anterior" id="precio_anterior">
                  </div>
                  <div class="col-md-6">
                    <label>Precio Publico</label>
                    <input type="text" value="{{$producto->precio_publico}}" data-msg-required="Please enter the subject." maxlength="100" class="form-control" name="precio_publico" id="precio_publico">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Permitir comentarios</label>
                    {{ Form::select('comentarios', array('si' => 'Si', 'no' => 'No'), 'si', array('class' => 'form-control input-lg', 'id' =>'comentarios')) }}
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

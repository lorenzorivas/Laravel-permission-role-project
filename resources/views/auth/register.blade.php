<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Register</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="{{ asset('assets_login/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets_login/css/material-bootstrap-wizard.css') }}" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets_login/css/demo.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="image-container set-full-height" style="background-image: url('{{ asset('assets_login/img/wizard-book.jpg') }}">

        <!--  Made With Material Kit  -->
        <a href="https://github.com/lorenzorivas/Laravel-permission-role-project" class="made-with-mk" target="_blank">
            <div class="brand">Info</div>
            <div class="made-with"><strong>@GitHub</strong></div>
        </a>

        <!--   Big container   -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-offset-2">
                    <!--      Wizard container        -->
                    <div class="wizard-container">
                        <div class="card wizard-card" data-color="red" id="wizardProfile">
                            <form method="POST" action="{{ route('register') }}">
                              @csrf
                                <div class="wizard-navigation">
                                    <ul>
                                        <li><a href="#about" data-toggle="tab">Cuenta</a></li>
                                        {{-- <li><a href="#account" data-toggle="tab">Account</a></li> --}}
                                        <li><a href="#address" data-toggle="tab">Datos</a></li>
                                    </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane" id="about">
                                        <div class="row">
                                            <h4 class="info-text"> 
                                                Empecemos con la información básica
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </h4>
                                            {{-- <div class="col-sm-4 col-sm-offset-1">
                                                <div class="picture-container">
                                                    <div class="picture">
                                                        <img src="{{ asset('assets_login/img/default-avatar.png') }}" class="picture-src" id="wizardPicturePreview" title="" />
                                                        <input type="file" name="profile_image" id="wizard-picture">
                                                    </div>
                                                    <h6>Elige una imagen <small>(opcional)</small></h6>
                                                </div>
                                            </div> --}}
                                            <div class="col-sm-5">
                                                
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                            <i class="material-icons">email</i>
                          </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Email <small>(requerido)</small></label>
                                                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" required="required">
                                                    </div>
                                                </div>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                            <i class="material-icons">vpn_key</i>
                          </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Contraseña <small>(requerido)</small></label>
                                                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required="required">
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                            <i class="material-icons">face</i>
                          </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Nombre de usuario <small>(requerido)</small></label>
                                                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" required="required">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                            <i class="material-icons">vpn_key</i>
                          </span>
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Repetir Contraseña <small>(requerido)</small></label>
                                                        <input name="password_confirmation" type="password" class="form-control" required="required">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane" id="account">
                                        <h4 class="info-text">A qué área perteneces? </h4>
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="This is good if you travel alone.">
                                                        <input type="radio" name="job" value="Design">
                                                        <div class="icon">
                                                            <i class="material-icons">weekend</i>
                                                        </div>
                                                        <h6>Ingeniería</h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this room if you're traveling with your family.">
                                                        <input type="radio" name="job" value="Code">
                                                        <div class="icon">
                                                            <i class="material-icons">home</i>
                                                        </div>
                                                        <h6>Family</h6>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select this option if you are coming with your team.">
                                                        <input type="radio" name="job" value="Code">
                                                        <div class="icon">
                                                            <i class="material-icons">business</i>
                                                        </div>
                                                        <h6>Business</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="tab-pane" id="address">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h4 class="info-text"> Agrega algunos datos extras </h4>
                                            </div>
                                            <div class="col-sm-7 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Cargo</label>
                                                    <input type="text" name="street_name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Contacto</label>
                                                    <input type="number" name="street_num" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">City</label>
                                                    <input type="text" name="city" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Country</label>
                                                    <select name="country" class="form-control">
                                                        <option disabled="" selected=""></option>
                                                        <option value="Afghanistan"> Afghanistan </option>
                                                        <option value="Albania"> Albania </option>
                                                        <option value="Algeria"> Algeria </option>
                                                        <option value="American Samoa"> American Samoa </option>
                                                        <option value="Andorra"> Andorra </option>
                                                        <option value="Angola"> Angola </option>
                                                        <option value="Anguilla"> Anguilla </option>
                                                        <option value="Antarctica"> Antarctica </option>
                                                        <option value="...">...</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-footer">
                                    <div class="pull-right">
                                        <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Siguiente' />
                                        <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' value='Finish' />
                                    </div>

                                    <div class="pull-left">
                                        <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- wizard container -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!--  big container -->

        <div class="footer">
            <div class="container text-center">
                <!-- Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a> -->
            </div>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="{{ asset('assets_login/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets_login/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets_login/js/jquery.bootstrap.js') }}" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="{{ asset('assets_login/js/material-bootstrap-wizard.js') }}"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
<script src="{{ asset('assets_login/js/jquery.validate.min.js') }}"></script>

</html>
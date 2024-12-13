    <div class="px-3">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="py-3 py-lg-4">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="page-title mb-0">Form Elements</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-none d-lg-block">
                            <ol class="breadcrumb m-0 float-end">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Elements</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="p-2">

                                        <form action="" method="post" enctype="multipart/form-data">

                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="usuario">Usuario</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="usuario" id="usuario" class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="pasw">Contraseña</label>
                                                <div class="col-md-10">
                                                    <input type="password" name="pasw" id="pasw" class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-2 row">
                                                <label class="form-label col-md-2 col-form-label">Roles</label> <br />
                                                <div class="col-md-10">
                                                    <select name="role_id" id="selectize-select">
                                                        <option value="" data-display="Select">Seleccione un rol.</option>
                                                        <?php foreach ($roles as $key => $rol) { ?>
                                                            <option value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="email">Email</label>
                                                <div class="col-md-10">
                                                    <input type="email" name="email" id="email" class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="nombre">Nombre</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="nombre" id="nombre" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="apellido">Apellido</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="apellido" id="apellido" class="form-control">
                                                </div>
                                            </div>

                                            <div class="mb-2 row">
                                                <label class="col-md-2 col-form-label" for="example-fileinput">Activo</label>
                                                <div class="col-md-10">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" name="activo" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary w-100" type="submit">Cargar usuario</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>

                            </div>
                            <!-- end row -->
                        </div>
                    </div> <!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
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
                                            <label class="col-md-2 col-form-label" for="simpleinput">Nombre de la categoria</label>
                                            <div class="col-md-10">
                                                <input type="text" name="nombre" id="simpleinput" class="form-control" value="<?= $categorias->nombre ?>">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-fileinput">Activo</label>
                                            <div class="col-md-10">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="activo" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= ($categorias->activo) ? 'checked' : ''; ?>>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary w-100" type="submit">Cargar categoria</button>
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
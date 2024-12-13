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
                                            <label class="col-md-2 col-form-label" for="simpleinput">Nombre del proyecto</label>
                                            <div class="col-md-10">
                                                <input type="text" name="nombre" id="simpleinput" class="form-control" value="<?= $proyecto->nombre ?>">
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="form-label col-md-2 col-form-label">Categorias</label> <br />
                                            <div class="col-md-10">
                                                <select name="cat_id" id="selectize-select">
                                                    <option value="" data-display="Select">Selecciona un categoria.</option>
                                                    <?php foreach ($categorias as $key => $categoria) { ?>
                                                        <option value="<?= $categoria->id ?>" <?= ($categoria->id == $proyecto->cat_id) ? 'selected' : '' ;?>><?= $categoria->nombre ?></option>
                                                    <?php }; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-textarea">Text area</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" name="descripcion" id="example-textarea" rows="5"><?= $proyecto->descripcion ?></textarea>
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label" for="example-fileinput">Default file input</label>
                                            <div class="col-md-10">
                                                <div class="input-group">
                                                    <a href="<?= $proyecto->img ?>" target="_blank" class="input-group-text" id="basic-addon1"><i class="fa-sharp fa-solid fa-image"></i></a>
                                                    <input multiple type="file" name="img" class="form-control" id="example-fileinput">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2 row">
                                            <label class="col-md-2 col-form-label">URL</label>
                                            <div class="col-md-10">
                                                <input class="form-control" name="url" type="url" value="<?= $proyecto->url ?>">
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-primary w-100" type="submit">Cargar proyecto</button>
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
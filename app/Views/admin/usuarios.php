<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Lista de usuarios</h4>
                <p class="sub-header">
                    <!-- Add <code>.table-bordered</code> for borders on all sides of the table and cells. -->
                </p>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">Secciones de portfolio</h4>
                                <!-- <p class="text-muted font-size-13 mb-4">
                                    DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction
                                    function:
                                    <code>$().DataTable();</code>.
                                </p> -->

                                <table id="basic-datatable" class="table dt-responsive nowrap w-100 table-bordered">
                                    <thead>
                                        <tr>
                                            <!-- <th class="text-center">Posicion</th> -->
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Apellido</th>
                                            <th class="text-center">Rol</th>
                                            <th class="text-center">Pass</th>
                                            <?php if (in_array('usuarios', $user->editar)): ?>
                                                <th class="text-center">Opciones</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($usuarios as $key => $us) {
                                            // debug($us, false);
                                        ?>
                                            <tr class="tr-<?= $us->id; ?>">
                                                <!-- <th class="text-center" scope="row"><?= $key; ?></th> -->
                                                <td><?= $us->usuario; ?></td>
                                                <td><?= $us->email; ?></td>
                                                <td><?= $us->nombre; ?></td>
                                                <td><?= $us->apellido; ?></td>
                                                <td><?= $us->role_id; ?></td>
                                                <td class="text-center "><a class="showdescrip" data-description="<?= $us->pasw; ?>">Ver password</a></td>
                                                <?php if (in_array('usuarios', $user->editar)): ?>
                                                    <td class="text-center d-flex justify-content-center gap-1" colspan="">
                                                        <a href="admin/update/usuarios/<?= $us->id; ?>"><i class="fa-sharp fa-solid fa-pen-to-square "></i></a>
                                                        <a href="" onclick="deleteusuarios(<?= $us->id; ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input ch-usuarios-<?= $us->id; ?>" onchange="changeactivousuarios(<?= $us->id; ?>)" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= ($us->activo) ? 'checked' : ''; ?>>
                                                        </div>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->

            </div>
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>
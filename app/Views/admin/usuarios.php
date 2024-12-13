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
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        // debug($usuarios);
                                        foreach ($usuarios as $key => $user) {
                                            // debug($user, false);
                                        ?>
                                            <tr class="tr-<?= $user->id; ?>">
                                                <!-- <th class="text-center" scope="row"><?= $key; ?></th> -->
                                                <td><?= $user->usuario; ?></td>
                                                <td><?= $user->email; ?></td>
                                                <td><?= $user->nombre; ?></td>
                                                <td><?= $user->apellido; ?></td>
                                                <td><?= $user->role_nombre; ?></td>
                                                <td class="text-center "><a class="showdescrip" data-description="<?= $user->pasw; ?>">Ver password</a></td>
                                                <td class="text-center d-flex justify-content-center gap-1" colspan="">
                                                    <a href="admin/update/usuarios/<?= $user->id; ?>"><i class="fa-sharp fa-solid fa-pen-to-square "></i></a>
                                                    <a href="" onclick="deleteusuarios(<?= $user->id; ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-sharp fa-solid fa-trash"></i></a>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input ch-usuarios-<?= $user->id; ?>" onchange="changeactivousuarios(<?= $user->id; ?>)" type="checkbox" role="switch" id="flexSwitchCheckChecked" <?= ($user->activo) ? 'checked' : ''; ?>>
                                                    </div>
                                                </td>
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
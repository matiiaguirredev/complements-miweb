function getCookie(nombre) {
    var nombreCookie = nombre + "=";
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim();
        if (cookie.indexOf(nombreCookie) == 0) {
            return cookie.substring(nombreCookie.length, cookie.length);
        }
    }

    return ""; // Retorna una cadena vacía si no se encuentra la cookie
}

function showAlert(type, message) {
    let errorMessagePrefix = message.split(":")[0];
    let content = `
    <div class="text-light alert bg-${type} alert-dismissible fade show" role="alert">
        <strong>${errorMessagePrefix}</strong>:${message.substring(errorMessagePrefix.length + 1)}
        <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    `;
    $(".alert-content").html(content);
    setTimeout(() => {
        $(".alert-content .close").click();
    }, 3000);
}

function deleteproyect(id) {
    $(".todelete").attr("href", "admin/delete/proyect/" + id);
}

function changeactivo(id) {
    data = [];
    data["activo"] = $(".ch-proyect-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-proyect-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/proyect/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(type, `${Response.nombre} ${msj} correctamente`);
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletelenguaje(id) {
    $(".todelete").attr("href", "admin/delete/lenguaje/" + id);
}

function changeactivolenguaje(id) {
    data = [];
    data["activo"] = $(".ch-lenguaje-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-lenguaje-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/lenguaje/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(type, `${Response.nombre} ${msj} correctamente`);
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteredes(id) {
    $(".todelete").attr("href", "admin/delete/redes/" + id);
}

function changeactivoredes(id) {
    data = [];
    data["activo"] = $(".ch-redes-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-redes-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/redes/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(type, `${Response.nombre} ${msj} correctamente`);
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletecategorias(id) {
    $(".todelete").attr("href", "admin/delete/categorias/" + id);
}

function changeactivocategorias(id) {
    data = [];
    data["activo"] = $(".ch-categorias-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-categorias-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/categorias/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(type, `${Response.nombre} ${msj} correctamente`);
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteservicios(id) {
    $(".todelete").attr("href", "admin/delete/servicios/" + id);
}

function changeactivoservicios(id) {
    data = [];
    data["activo"] = $(".ch-servicios-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-servicios-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/servicios/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El proyecto ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletecurriculum(id) {
    $(".todelete").attr("href", "admin/delete/curriculum/" + id);
}

function changeactivocurriculum(id) {
    data = [];
    data["activo"] = $(".ch-curriculum-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-curriculum-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/curriculum/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El proyecto ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletehobies(id) {
    $(".todelete").attr("href", "admin/delete/hobies/" + id);
}

function changeactivohobies(id) {
    data = [];
    data["activo"] = $(".ch-hobies-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-hobies-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/hobies/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo,
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El hobbie ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletecontacto(id) {
    $(".todelete").attr("href", "admin/delete/contacto/" + id);
}

function changeactivocontacto(id) {
    data = [];
    data["activo"] = $(".ch-contacto-" + id).is(":checked") ? 1 : 0;
    data["token"] = getCookie("token");
    activo = $(".ch-contacto-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/contacto/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo + 
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El contacto ${Response.info_secundaria} se ha ${msj} correctamente`
            );
            console.log("es esto¿????",Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletesecciones(id) {
    $(".todelete").attr("href", "admin/delete/secciones/" + id);
}

function changeactivosecciones(id) {
    data = [];
    data["activo"] = $(".ch-secciones-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-secciones-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/secciones/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `La seccion ${Response.titulos} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletetxtbanner(id) {
    $(".todelete").attr("href", "admin/delete/txtbanner/" + id);
}

function changeactivotxt(id) {
    data = [];
    data["activo"] = $(".ch-txtbanner-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-txtbanner-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/txtbanner/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El texto ${Response.txtBanner} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

// funcion con ajax realizada por mi, feliz !
function deleteclientes(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-txtbanner-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-txtbanner-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/clientes/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        window.location.href = "./admin/clientes";
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivocli(id) {
    data = [];
    data["activo"] = $(".ch-clientes-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-clientes-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/clientes/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El cliente ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deletetestimonios(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-testimonios-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-testimonios-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/testimonios/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        // window.location.href = "./admin/testimonios";
                        $(".tr-" + id).html("<td colspan='99' class='bg-success text-center text-white'>Eliminado satisfactoriamente</td>");
                        setTimeout(() => {
                            $(".tr-" + id).hide('slide');
                        }, 2000);

                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivotestimonios(id) {
    data = [];
    data["activo"] = $(".ch-testimonios-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-testimonios-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/testimonios/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El testimonio ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteblog(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-blog-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-blog-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/blog/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        // window.location.href = "./admin/blog";
                        $(".tr-" + id).html("<td colspan='99' class='bg-success text-center text-white'>Eliminado satisfactoriamente</td>");
                        setTimeout(() => {
                            $(".tr-" + id).hide('slide');
                        }, 2000);

                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivoblog(id) {
    data = [];
    data["activo"] = $(".ch-blog-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-blog-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/blog/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El blog ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteblogCat(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-blogCat-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-blogCat-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/blogCat/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        // window.location.href = "./admin/blogCat";
                        $(".tr-" + id).html("<td colspan='99' class='bg-success text-center text-white'>Eliminado satisfactoriamente</td>");
                        setTimeout(() => {
                            $(".tr-" + id).hide('slide');
                        }, 2000);

                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivobCat(id) {
    data = [];
    data["activo"] = $(".ch-blogCat-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-blogCat-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/blogCat/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El blogCat ${Response.titulo} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteblogComm(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-blogComm-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-blogComm-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/blogComm/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        // window.location.href = "./admin/blogComm";
                        $(".tr-" + id).html("<td colspan='99' class='bg-success text-center text-white'>Eliminado satisfactoriamente</td>");
                        setTimeout(() => {
                            $(".tr-" + id).hide('slide');
                        }, 2000);

                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivoblogComm(id) {
    data = [];
    data["activo"] = $(".ch-blogComm-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-blogComm-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/blogComm/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El blogComm ${Response.autor} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteusuarios(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-usuarios-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-usuarios-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/usuarios/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        // window.location.href = "./admin/blogComm";
                        $(".tr-" + id).html("<td colspan='99' class='bg-success text-center text-white'>Eliminado satisfactoriamente</td>");
                        setTimeout(() => {
                            $(".tr-" + id).hide('slide');
                        }, 2000);

                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivousuarios(id) {
    data = [];
    data["activo"] = $(".ch-usuarios-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-usuarios-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/usuarios/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El usuario ${Response.usuario} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

function deleteroles(id) {
    /* $(".todelete").attr("href", "admin/delete/clientes/" + id); */
    data = [];
    data["activo"] = $(".ch-roles-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-roles-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                async: true,
                type: "POST",
                dataType: "json",
                url:
                    "./api/delete/roles/" +
                    id +
                    "?token=" +
                    getCookie("token") +
                    "&activo=" +
                    activo +
                    "&notnull=1",
                data: data,
                contentType: "application/json; charset=utf-8",
                processData: false,

                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    ).then(() => {
                        // window.location.href = "./admin/blogComm";
                        $(".tr-" + id).html("<td colspan='99' class='bg-success text-center text-white'>Eliminado satisfactoriamente</td>");
                        setTimeout(() => {
                            $(".tr-" + id).hide('slide');
                        }, 2000);

                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
}

function changeactivoroles(id) {
    data = [];
    data["activo"] = $(".ch-roles-" + id).is(":checked") ? 1 : 0;
    data["notnull"] = 1;
    data["token"] = getCookie("token");
    activo = $(".ch-roles-" + id).is(":checked") ? 1 : 0;
    msj = activo ? "Activado" : "Desactivado";
    type = activo ? "success" : "danger";

    console.log("data", data);

    $.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url:
            "./api/update/roles/" +
            id +
            "?token=" +
            getCookie("token") +
            "&activo=" +
            activo +
            "&notnull=1",
        data: data,
        contentType: "application/json; charset=utf-8",
        // contentType: false,
        processData: false,
    })
        .done(function (Response) {
            //do something when get response
            showAlert(
                type,
                `El rol ${Response.role_name} se ha ${msj} correctamente`
            );
            console.log(Response);
        })
        .fail(function (Response) {
            //do something when any error occurs.
            showAlert("danger", Response.error);
            console.error(Response);
        });
}

//MODAL DE DESCRIPCIONES DE PROYECTOS.
$(document).on("click", ".showdescrip", function (e) {
    e.preventDefault();
    Swal.fire({ title: $(this).data("description") });
});


// VERIFICACIONES DE CLASE IMG PARA AGREGADO DE BTN
// console.log("cantidad", $(".input-group-text").length );
if ($(".input-group-text").length > 0) {
    $(".input-group-text").each(function () { // Recorremos cada una de las que existen con la correspondiente URL
        var img = $(this).attr("href"); // Obtenemos la URL del atributo href
        // Verificamos si el elemento tiene la clase "delete"
        if (img && !$(this).hasClass("delete")) {
            var html = `
            <button class="btn btn-outline-secondary del-img" type="button" data-img="${img}">
                <i class="fa fa-trash"></i>
            </button>
            `;
            $(this).parent().append(html); // Añadimos el botón solo si no tiene la clase "delete"
        }
    });
}

// ajax para borrar las img
$(document).on("click", ".del-img", function (e) {
    e.preventDefault(); // Evitar que se siga el enlace por defecto

    var ruta = $(this).data("img"); // Obtener la ruta de la imagen a eliminar
    // console.log("href", ruta);
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Capturar la URL actual
            const url = window.location.href;

            // Crear un elemento URL para descomponerla
            const urlObj = new URL(url);
            // console.log("utl", urlObj);

            // Separando el pathname en partes individuales
            const pathSegments = urlObj.pathname.split('/').filter(segment => segment.length > 0);
            // console.log("path", pathSegments);

            // Obtener update, secciones e id
            const funcion = pathSegments[1];
            const seccion = pathSegments[2];
            const id = pathSegments[3];

            // Construir el objeto data con todos los datos necesarios
            // Objeto de datos original
            const data = {
                funcion: funcion,
                seccion: seccion,
                id: id,
                token: getCookie("token"),
                ruta: ruta
            };
            console.log("ACA ESTA LA DATA A VER QUE ME TRAE", data);
            // Crear un nuevo FormData
            const formData = new FormData();

            // Iterar sobre el objeto data y añadir cada par clave-valor al FormData
            $get = ''
            for (let key in data) {
                if (!$get) {
                    $get += '?'
                }
                $get += `${key}=${data[key]}&`;
                formData.append(key, data[key]);
                // console.log("key", key);

            }
            // console.log("get", $get);
            // Construir la URL para la solicitud AJAX
            const ajaxUrl = `./api/delete/img/`;

            $.ajax({
                url: ajaxUrl + $get,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false, // Evitar que jQuery convierta los datos en una cadena de consulta
                beforeSend: function () {

                },
                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    );
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
});


if ($(".delete").length > 0) {
    $(".delete").each(function () { // Recorremos cada uno de los elementos con la clase delete
        var img = $(this).attr("href"); // Obtenemos la URL del atributo href
        // Verificamos si el enlace tiene la clase "delete" (que es nuestra clase de referencia)
        if (img) {
            var html = `
            <button class="btn btn-outline-secondary del-perfil-img" type="button" data-img="${img}">
                <i class="fa fa-trash"></i>
            </button>
            `;
            $(this).parent().append(html); // Añadimos el botón con la clase del-perfil-img
        }
    });
}

$(document).on("click", ".del-perfil-img", function (e) {
    e.preventDefault(); // Evitar la acción por defecto

    var ruta = $(this).data("img"); // Obtener la URL de la imagen del botón
    console.log("Ruta de la imagen:", ruta);

    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar datos al API mediante AJAX
            $.ajax({
                url: "http://web-landing/api/delete/img/perfil", // Ruta del API
                type: "POST",
                data: {
                    ruta: ruta, // URL de la imagen
                },
                success: function (response) {
                    console.log('Respuesta del servidor:', response);
                    Swal.fire(
                        '¡Eliminado!',
                        'Tu archivo ha sido eliminado.',
                        'success'
                    );
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                    Swal.fire(
                        'Abortado',
                        'El servidor no pudo eliminar el archivo',
                        'error'
                    );
                }
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
                'Cancelado',
                'Tu archivo está a salvo :)',
                'error'
            );
        }
    });
});








tinymce.init({
        selector: '#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        branding: false,
        setup: function (editor) {
        // Evento que se dispara cuando el contenido del editor cambia
        editor.on('SetContent Change', function () {
            // Selecciona todos los elementos blockquote dentro del editor
            const blockquotes = editor.getBody().querySelectorAll('blockquote');
    
            // Añadir clase 'blockquote' a cada blockquote
            blockquotes.forEach(blockquote => {
            if (!blockquote.classList.contains('blockquote')) {
                blockquote.classList.add('blockquote');
            }
            });
            
            // Actualiza el valor del textarea con el contenido del editor
            document.getElementById('content').value = editor.getContent();
        });
        }
});
    
$(".select-multiple").selectize({create:!0,sortField:{field:"text",direction:"asc"},dropdownParent:"body"});
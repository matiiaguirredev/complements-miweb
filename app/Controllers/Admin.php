<?php

namespace App\Controllers;

class Admin extends BaseController {

    private $db = null;
    private $key = null;
    private $urlAPI = "http://web-landing/api/";
    private $user = null;
    private $data = null;
    private $token = null;
    private $rolesAllowed = [];

    public function __construct() {

        $this->db = \Config\Database::connect();
        $this->key = getenv('KEYENCRIPT');
        $this->data = [];
    }

    public function login($var = true) {
        // $this->data = [];
        // debug($this->data);
        if ($var && $this->request->getGetPost()) {
            $login = json_decode(send_post($this->urlAPI . "login", $this->request->getGetPost()));
            // debug($this->urlAPI ."login");
            // debug($login);

            if (isset($login->error)) {
                $this->data['error'] = $login->error;
            } else {
                setcookie("token", $login->token, 0, "/");
                return redirect()->to('/admin');
            }
        }

        $this->header();
        // echo view('admin/login', $this->data);
        echo view('admin/pages-login', $this->data);
        $this->footer();
    }

    public function logout() {
        $tiempo = time() - 3600;
        setcookie("token", "", $tiempo, "/");
        header("Location: /admin/login");
        exit();
    }

    public function index() {

        $this->valtoken();
        $this->header();
        $this->sidebar();
        echo view('admin/index');
        $this->footer();
    }

    private function header() {
        $this->data["user"] = $this->user;
        // debug($this->data["user"]);
        echo view('admin/header', $this->data);
    }

    private function sidebar() {

        echo view('admin/sidebar', $this->data);
        // debug($this->data);
    }

    private function footer() {
        // $this->data["user"] = $this->user;
        echo view('admin/footer', $this->data);
    }

    public function register() {

        $this->data = [];
        $view = true;
        if ($this->request->getGetPost()) {
            $register = json_decode(send_post($this->urlAPI . "register", $this->request->getGetPost()));
            if (isset($register->error)) {
                $this->data['error'] = $register->error;
            } else {
                $this->data['success'] = "Registro creado exitosamente";
                $this->login(false);
                $view = false;
            }
        }

        if ($view) {
            $this->header();
            echo view('admin/pages-register', $this->data);
            $this->footer();
        }
    }

    public function recover() {

        $this->header();
        echo view('admin/pages-recover');
        $this->footer();
    }

    // FUNCIONES PROYECTOS

    public function get_proyect() {
        $this->valtoken();
        $token = $this->request->getCookie("token");


        $this->data['proyectos'] = [];
        $proyect = json_decode(send_post($this->urlAPI . "proyect", ["token" => $token]));
        // debug($proyect);
        if (isset($proyect->error)) {
            $this->data['error'] = $proyect->error;
        } else {
            $this->data['proyectos'] = $proyect;
        }

        $view = true;

        if ($view) {
            $this->data['categorias'] = [];
            $categorias = json_decode(send_post($this->urlAPI . "categorias?activo=1", ["token" => $token]));
            // debug ($categorias,false);
            if (isset($categorias->error)) {
                $this->data['error'] = $categorias->error;
            } else {
                $this->data['categorias'] = $categorias;
            }
            $this->header();
            $this->sidebar();
            echo view('admin/proyects', $this->data);
            $this->footer();
        }
    }

    public function create_proyect() {

        $this->valtoken();
        $view = true;

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('proyect', $this->user->crear)) {
            return redirect()->back()->with('error', 'No tienes los permisos necesarios.');
            exit;
        }

        // debug($this->request->getGetPost(), false);

        if ($this->request->getGetPost()) {
            $token = $this->request->getCookie("token");
            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 
            // debug($requestData);
            // debug($_FILES);
            foreach ($_FILES as $k => $v) {
                if (strlen($v['name'])) {
                    $requestData[$k] = curl_file_create($v['tmp_name'], $v['type'], basename($v['name']));
                }
            }


            $create_proyect = json_decode(send_post($this->urlAPI . "create/proyect", $requestData)); // envio directamente la variable que tiene todo ya concatenado
            // debug($create_proyect, false);
            if (isset($create_proyect->error)) {
                $this->data['error'] = $create_proyect->error;
                // debug($this->data['error']);
            } else {
                $this->data['success'] = "Proyecto creado exitosamente";
                $this->get_proyect();
                $view = false;
            }
        }

        if ($view) {

            $this->data['categorias'] = [];
            $categorias = json_decode(send_post($this->urlAPI . "categorias?activo=1"));
            if (isset($categorias->error)) {
                $this->data['error'] = $categorias->error;
            } else {
                $this->data['categorias'] = $categorias;
            }


            $this->header();
            $this->sidebar();
            echo view('admin/newproyect', $this->data);
            $this->footer();
        }
    }

    public function update_proyect($id) {

        $this->valtoken();

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('proyect', $this->user->editar)) {
            return redirect()->back()->with('error', 'No tienes los permisos necesarios.');
            exit;
        }

        $view = true;
        $token = $this->request->getCookie("token");

        if ($this->request->getGetPost()) {

            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 
            // debug($_FILES);
            foreach ($_FILES as $k => $v) {
                if (strlen($v['name'])) {
                    $requestData[$k] = curl_file_create($v['tmp_name'], $v['type'], basename($v['name']));
                }
            }
            $update_proyect = json_decode(send_post($this->urlAPI . "update/proyect/" . $id, $requestData)); // envio directamente la variable que tiene todo ya concatenado
            // debug($update_proyect, false);
            if (isset($update_proyect->error)) {
                $this->data['error'] = $update_proyect->error;
            } else {
                $this->data['success'] = "Proyecto modificado exitosamente";
                $this->get_proyect();
                $view = false;
            }
        }

        if ($view) {
            $this->data['proyecto'] = [];
            $proyect = json_decode(send_post($this->urlAPI . "proyect/" . $id, ["token" => $token]));
            if (isset($proyect->error)) {
                $this->data['error'] = $proyect->error;
            } else {
                $this->data['proyecto'] = $proyect;
            }
            $this->data['categorias'] = [];
            $categorias = json_decode(send_post($this->urlAPI . "categorias?activo=1", ["token" => $token]));
            if (isset($categorias->error)) {
                $this->data['error'] = $categorias->error;
            } else {
                $this->data['categorias'] = $categorias;
            }
            $this->header();
            $this->sidebar();
            echo view('admin/edit-proyect');
            $this->footer();
        }
    }

    public function delete_proyect($id) {
        // $this->valtoken();
        $token = $this->request->getCookie("token");

        // $this->data = [];
        if ($id) {
            $requestData = ["token" => $token]; // Datos para enviar a la API
            $delete_proyect = json_decode(send_post($this->urlAPI . "delete/proyect/" . $id, $requestData));

            if (isset($delete_proyect->error)) {
                $this->data['error'] = $delete_proyect->error;
            } else {
                // El proyecto se eliminó exitosamente
                $this->data['success'] = "Proyecto eliminado exitosamente";
            }
        }
        $this->get_proyect();
        // header("Location: /admin/proyects");
        // exit();
    }

    // FIN FUNCIONES PROYECTOS

    // FUNCIONES CATEGORIAS
    public function get_categorias() {
        $this->valtoken();
        $token = $this->request->getCookie("token");

        $this->data['categorias'] = [];
        $categorias = json_decode(send_post($this->urlAPI . "categorias", ["token" => $token]));
        if (isset($categorias->error)) {
            $this->data['error'] = $categorias->error;
        } else {
            $this->data['categorias'] = $categorias;
        }

        $this->header();
        $this->sidebar();
        echo view('admin/categorias', $this->data);
        $this->footer();
    }

    public function create_categorias() {

        $this->valtoken();
        $view = true;

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('categorias', $this->user->crear)) {
            return redirect()->back()->with('error', 'No tienes los permisos necesarios.');
            exit;
        }

        if ($this->request->getGetPost()) {
            $token = $this->request->getCookie("token");
            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 
            // debug($_FILES,false);
            foreach ($_FILES as $k => $v) {
                if (strlen($v['name'])) {
                    $requestData[$k] = curl_file_create($v['tmp_name'], $v['type'], basename($v['name']));
                }
            }
            $create_categorias = json_decode(send_post($this->urlAPI . "create/categorias", $requestData)); // envio directamente la variable que tiene todo ya concatenado
            // debug($create_categorias, false);
            if (isset($create_categorias->error)) {
                $this->data['error'] = $create_categorias->error;
            } else {
                $this->data['success'] = "Categoria creada exitosamente";
                $this->get_categorias();
                $view = false;
            }
            // debug($create_categorias, false);

        }

        if ($view) {
            $this->header();
            $this->sidebar();
            echo view('admin/newcategorias');
            $this->footer();
        }
    }

    public function update_categorias($id) {

        $this->valtoken();

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('categorias', $this->user->editar)) {
            return redirect()->back()->with('error', 'No tienes los permisos necesarios.');
            exit;
        }

        $view = true;
        $token = $this->request->getCookie("token");

        if ($this->request->getGetPost()) {

            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 
            // debug($_FILES);
            foreach ($_FILES as $k => $v) {
                if (strlen($v['name'])) {
                    $requestData[$k] = curl_file_create($v['tmp_name'], $v['type'], basename($v['name']));
                }
            }
            $update_categorias = json_decode(send_post($this->urlAPI . "update/categorias/" . $id, $requestData)); // envio directamente la variable que tiene todo ya concatenado
            // debug($update_categorias, false);
            if (isset($update_categorias->error)) {
                $this->data['error'] = $update_categorias->error;
            } else {
                $this->data['success'] = "Categoria modificada exitosamente";
                $this->get_categorias();
                $view = false;
            }
            // debug($update_redes, false);

        }

        if ($view) {
            $this->data['categorias'] = [];
            $categorias = json_decode(send_post($this->urlAPI . "categorias/" . $id, ["token" => $token]));
            if (isset($categorias->error)) {
                $this->data['error'] = $categorias->error;
            } else {
                $this->data['categorias'] = $categorias;
            }
            $this->header();
            $this->sidebar();
            echo view('admin/edit-categorias');
            $this->footer();
        }
    }

    public function delete_categorias($id) {
        // $this->valtoken();
        $token = $this->request->getCookie("token");

        // $this->data = [];
        if ($id) {
            $requestData = ["token" => $token]; // Datos para enviar a la API
            $delete_categorias = json_decode(send_post($this->urlAPI . "delete/categorias/" . $id, $requestData));

            if (isset($delete_categorias->error)) {
                $this->data['error'] = $delete_categorias->error;
            } else {
                // El proyecto se eliminó exitosamente
                $this->data['success'] = "Categoria eliminada exitosamente";
            }
        }
        $this->get_categorias();
        // header("Location: /admin/proyects");
        // exit();
    }

    // FIN FUNCIONES CATEGORIAS


    // CRUD USUARIOS

    public function get_usuarios() {
        $this->valtoken();
        $token = $this->request->getCookie("token");

        if (!in_array('usuarios', $this->user->ver)) {
            return redirect()->to(base_url('/admin'))->with('error', 'Pagina no encontrada');
            exit;
        }

        $this->data['usuarios'] = [];
        $usuarios = json_decode(send_post($this->urlAPI . "usuarios", ["token" => $token]));
        // debug($usuarios);
        if (isset($usuarios->error)) {
            $this->data['error'] = $usuarios->error;
        } else {
            $this->data['usuarios'] = $usuarios;
        }

        $view = true;

        if ($view) {
            $this->header();
            $this->sidebar();
            echo view('admin/usuarios', $this->data);
            $this->footer();
        }
    }

    public function create_usuarios() {

        $this->valtoken();
        $view = true;

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('usuarios', $this->user->crear)) {
            return redirect()->to(base_url('/admin'))->with('error', 'Pagina no encontrada');
            exit;
        }

        if ($this->request->getGetPost()) {
            $token = $this->request->getCookie("token");
            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 

            $create_usuarios = json_decode(send_post($this->urlAPI . "create/usuarios", $requestData)); // envio directamente la variable que tiene todo ya concatenado
            if (isset($create_usuarios->error)) {
                $this->data['error'] = $create_usuarios->error;
            } else {
                $this->data['success'] = "Informacion de usuarios creada exitosamente";
                $this->get_usuarios();
                $view = false;
            }
        }

        if ($view) {
            $token = $this->request->getCookie("token");

            $this->data['usuarios'] = [];
            $usuarios = json_decode(send_post($this->urlAPI . "usuarios", ["token" => $token]));
            if (isset($usuarios->error)) {
                $this->data['error'] = $usuarios->error;
                // debug($this->data['error']);
            } else {
                $this->data['usuarios'] = $usuarios;
            }

            $this->data['roles'] = [];
            $roles = json_decode(send_post($this->urlAPI . "roles?activo=1", ["token" => $token]));
            if (isset($roles->error)) {
                $this->data['error'] = $roles->error;
            } else {
                $this->data['roles'] = $roles;
            }


            $this->header();
            $this->sidebar();
            echo view('admin/newusuarios', $this->data);
            $this->footer();
        }
    }

    public function update_usuarios($id) {

        $this->valtoken();
        $view = true;
        $token = $this->request->getCookie("token");

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('usuarios', $this->user->editar)) {
            return redirect()->to(base_url('/admin'))->with('error', 'Pagina no encontrada');
            exit;
        }

        if ($this->request->getGetPost()) {

            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 

            $update_usuarios = json_decode(send_post($this->urlAPI . "update/usuarios/" . $id, $requestData)); // envio directamente la variable que tiene todo ya concatenado
            if (isset($update_usuarios->error)) {
                $this->data['error'] = $update_usuarios->error;
            } else {
                $this->data['success'] = "Informacion de usuarios modificada exitosamente";
                $this->get_usuarios();
                $view = false;
            }
        }

        if ($view) {

            $token = $this->request->getCookie("token");

            $this->data['usuarios'] = [];
            $usuarios = json_decode(send_post($this->urlAPI . "usuarios/" . $id, ["token" => $token]));
            // debug($usuarios);
            if (isset($usuarios->error)) {
                $this->data['error'] = $usuarios->error;
            } else {
                $this->data['usuarios'] = $usuarios;
            }

            $this->data['roles'] = [];
            $roles = json_decode(send_post($this->urlAPI . "roles?activo=1", ["token" => $token]));
            if (isset($roles->error)) {
                $this->data['error'] = $roles->error;
            } else {
                $this->data['roles'] = $roles;
            }


            $this->header();
            $this->sidebar();
            echo view('admin/edit-usuarios');
            $this->footer();
        }
    }

    public function delete_usuarios($id) {
        // $this->valtoken();
        $token = $this->request->getCookie("token");

        // $this->data = [];
        if ($id) {
            $requestData = ["token" => $token]; // Datos para enviar a la API
            $delete_usuarios = json_decode(send_post($this->urlAPI . "delete/usuarios/" . $id, $requestData));

            if (isset($delete_usuarios->error)) {
                $this->data['error'] = $delete_usuarios->error;
            } else {
                // El proyecto se eliminó exitosamente
                $this->data['success'] = "Informacion de usuarios eliminada exitosamente";
            }
        }
        $this->get_usuarios();
    }

    // FIN CRUD USUARIOS

    // CRUD ROLES

    public function get_roles() {
        $this->valtoken();
        $token = $this->request->getCookie("token");

        if (!in_array('roles', $this->user->ver)) {
            return redirect()->to(base_url('/admin'))->with('error', 'Pagina no encontrada');
            exit;
        }

        $this->data['roles'] = [];
        $roles = json_decode(send_post($this->urlAPI . "roles", ["token" => $token]));
        if (isset($roles->error)) {
            $this->data['error'] = $roles->error;
        } else {
            $this->data['roles'] = $roles;
        }

        $view = true;

        if ($view) {
            $this->header();
            $this->sidebar();
            echo view('admin/roles', $this->data);
            $this->footer();
        }
    }

    public function create_roles() {

        $this->valtoken();
        $token = $this->request->getCookie("token");
        $view = true;

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('roles', $this->user->crear)) {
            return redirect()->to(base_url('/admin'))->with('error', 'Pagina no encontrada');
            exit;
        }

        if ($this->request->getGetPost()) {
            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]); // en una variable tengo que guardar el merge 

            // Procesar todas las acciones (ver, crear, editar, borrar)
            $actions = ['ver', 'crear', 'editar', 'borrar'];
            foreach ($actions as $action) {
                if (isset($requestData[$action]) && is_array($requestData[$action])) {
                    // Convierte arrays en cadenas separadas por comas
                    $requestData[$action] = implode(',', $requestData[$action]);
                }
            }

            $create_roles = json_decode(send_post($this->urlAPI . "create/roles", $requestData)); // envio directamente la variable que tiene todo ya concatenado
            if (isset($create_roles->error)) {
                $this->data['error'] = $create_roles->error;
            } else {
                $this->data['success'] = "Informacion de roles creada exitosamente";
                $this->get_roles();
                $view = false;
            }
        }

        if ($view) {
            if ($this->user->id != 1) {  
                $this->data['secciones'] = [
                    [
                        'alias' => 'proyect',
                        'titulo' => 'Proyectos'
                    ],
                    [
                        'alias' => 'lenguaje',
                        'titulo' => 'Lenguaje'
                    ],
                    [
                        'alias' => 'redes',
                        'titulo' => 'Redes'
                    ],
                    [
                        'alias' => 'categorias',
                        'titulo' => 'Categorías'
                    ],
                    [
                        'alias' => 'servicios',
                        'titulo' => 'Servicios'
                    ],
                    [
                        'alias' => 'curriculum',
                        'titulo' => 'Currículum'
                    ],
                    [
                        'alias' => 'perfil',
                        'titulo' => 'Perfil'
                    ],
                    [
                        'alias' => 'hobies',
                        'titulo' => 'Hobbies'
                    ],
                    [
                        'alias' => 'contacto',
                        'titulo' => 'Contacto'
                    ],
                    [
                        'alias' => 'secciones',
                        'titulo' => 'Secciones'
                    ],
                    [
                        'alias' => 'navbar',
                        'titulo' => 'Navbar'
                    ],
                    [
                        'alias' => 'txtbanner',
                        'titulo' => 'Texto Banner'
                    ],
                    [
                        'alias' => 'clientes',
                        'titulo' => 'Clientes'
                    ],
                    [
                        'alias' => 'testimonios',
                        'titulo' => 'Testimonios'
                    ],
                    [
                        'alias' => 'blog',
                        'titulo' => 'Blog'
                    ],
                    [
                        'alias' => 'blogCat',
                        'titulo' => 'Categorías del Blog'
                    ],
                    [
                        'alias' => 'blogComm',
                        'titulo' => 'Comentarios del Blog'
                    ],
                    [
                        'alias' => 'blogComm2',
                        'titulo' => 'Comentarios del Blog (Versión 2)'
                    ],
                ];
            } else {
                $this->data['secciones'] = [
                    [
                        'alias' => 'proyect',
                        'titulo' => 'Proyectos'
                    ],
                    [
                        'alias' => 'lenguaje',
                        'titulo' => 'Lenguaje'
                    ],
                    [
                        'alias' => 'redes',
                        'titulo' => 'Redes'
                    ],
                    [
                        'alias' => 'categorias',
                        'titulo' => 'Categorías'
                    ],
                    [
                        'alias' => 'servicios',
                        'titulo' => 'Servicios'
                    ],
                    [
                        'alias' => 'curriculum',
                        'titulo' => 'Currículum'
                    ],
                    [
                        'alias' => 'perfil',
                        'titulo' => 'Perfil'
                    ],
                    [
                        'alias' => 'hobies',
                        'titulo' => 'Hobbies'
                    ],
                    [
                        'alias' => 'contacto',
                        'titulo' => 'Contacto'
                    ],
                    [
                        'alias' => 'secciones',
                        'titulo' => 'Secciones'
                    ],
                    [
                        'alias' => 'navbar',
                        'titulo' => 'Navbar'
                    ],
                    [
                        'alias' => 'txtbanner',
                        'titulo' => 'Texto Banner'
                    ],
                    [
                        'alias' => 'clientes',
                        'titulo' => 'Clientes'
                    ],
                    [
                        'alias' => 'testimonios',
                        'titulo' => 'Testimonios'
                    ],
                    [
                        'alias' => 'blog',
                        'titulo' => 'Blog'
                    ],
                    [
                        'alias' => 'blogCat',
                        'titulo' => 'Categorías del Blog'
                    ],
                    [
                        'alias' => 'blogComm',
                        'titulo' => 'Comentarios del Blog'
                    ],
                    [
                        'alias' => 'blogComm2',
                        'titulo' => 'Comentarios del Blog (Versión 2)'
                    ],
                    [
                        'alias' => 'usuarios',
                        'titulo' => 'Usuarios'
                    ],
                    [
                        'alias' => 'roles',
                        'titulo' => 'Roles'
                    ],
                ];
            }

            // Recuperar datos del rol, si existe
            if (isset($roles)) {
                $this->data['selectedVer'] = explode(',', $roles->ver);
                $this->data['selectedCrear'] = explode(',', $roles->crear);
                $this->data['selectedEditar'] = explode(',', $roles->editar);
                $this->data['selectedBorrar'] = explode(',', $roles->borrar);
            } else {
                // Si no hay un rol, las selecciones estarán vacías
                $this->data['selectedVer'] = [];
                $this->data['selectedCrear'] = [];
                $this->data['selectedEditar'] = [];
                $this->data['selectedBorrar'] = [];
            }

            // Renderizar la vista
            $this->header();
            $this->sidebar();
            echo view('admin/newroles', $this->data);
            $this->footer();
        }
    }

    public function update_roles($id) {
        $this->valtoken();
        $view = true;
        $token = $this->request->getCookie("token");

        // Roles permitidos para ver esta funcionalidad
        if (!in_array('roles', $this->user->editar)) {
            return redirect()->to(base_url('/admin'))->with('error', 'Pagina no encontrada');
            exit;
        }
        // Proceso de actualización
        if ($this->request->getGetPost()) {
            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]);

            // Procesar todas las acciones (ver, crear, editar, borrar)
            $actions = ['ver', 'crear', 'editar', 'borrar'];
            foreach ($actions as $action) {
                if (isset($requestData[$action]) && is_array($requestData[$action])) {
                    $requestData[$action] = implode(',', $requestData[$action]);
                }
            }

            $update_roles = json_decode(send_post($this->urlAPI . "update/roles/" . $id, $requestData));
            if (isset($update_roles->error)) {
                $this->data['error'] = $update_roles->error;
            } else {
                $this->data['success'] = "Información de roles modificada exitosamente";
                $this->get_roles();
                $view = false;
            }
        }

        // Renderizar vista de edición
        if ($view) {
            $this->data['roles'] = [];
            $roles = json_decode(send_post($this->urlAPI . "roles/" . $id, ["token" => $token]));

            if (isset($roles->error)) {
                $this->data['error'] = $roles->error;
            } else {
                $this->data['roles'] = $roles; // Datos recuperados del rol

                // Convertir las cadenas separadas por comas en arrays para cada acción
                $actions = ['ver', 'crear', 'editar', 'borrar'];
                foreach ($actions as $action) {
                    if (isset($roles->$action)) {
                        $this->data[$action] = explode(',', $roles->$action);
                    } else {
                        $this->data[$action] = []; // Si no está definido, asigna un array vacío
                    }
                }
            }

            // Opciones disponibles para el select
            if ($this->user->id != 1) {  
                $this->data['secciones'] = [
                    [
                        'alias' => 'proyect',
                        'titulo' => 'Proyectos'
                    ],
                    [
                        'alias' => 'lenguaje',
                        'titulo' => 'Lenguaje'
                    ],
                    [
                        'alias' => 'redes',
                        'titulo' => 'Redes'
                    ],
                    [
                        'alias' => 'categorias',
                        'titulo' => 'Categorías'
                    ],
                    [
                        'alias' => 'servicios',
                        'titulo' => 'Servicios'
                    ],
                    [
                        'alias' => 'curriculum',
                        'titulo' => 'Currículum'
                    ],
                    [
                        'alias' => 'perfil',
                        'titulo' => 'Perfil'
                    ],
                    [
                        'alias' => 'hobies',
                        'titulo' => 'Hobbies'
                    ],
                    [
                        'alias' => 'contacto',
                        'titulo' => 'Contacto'
                    ],
                    [
                        'alias' => 'secciones',
                        'titulo' => 'Secciones'
                    ],
                    [
                        'alias' => 'navbar',
                        'titulo' => 'Navbar'
                    ],
                    [
                        'alias' => 'txtbanner',
                        'titulo' => 'Texto Banner'
                    ],
                    [
                        'alias' => 'clientes',
                        'titulo' => 'Clientes'
                    ],
                    [
                        'alias' => 'testimonios',
                        'titulo' => 'Testimonios'
                    ],
                    [
                        'alias' => 'blog',
                        'titulo' => 'Blog'
                    ],
                    [
                        'alias' => 'blogCat',
                        'titulo' => 'Categorías del Blog'
                    ],
                    [
                        'alias' => 'blogComm',
                        'titulo' => 'Comentarios del Blog'
                    ],
                    [
                        'alias' => 'blogComm2',
                        'titulo' => 'Comentarios del Blog (Versión 2)'
                    ],
                ];
            } else {
                $this->data['secciones'] = [
                    [
                        'alias' => 'proyect',
                        'titulo' => 'Proyectos'
                    ],
                    [
                        'alias' => 'lenguaje',
                        'titulo' => 'Lenguaje'
                    ],
                    [
                        'alias' => 'redes',
                        'titulo' => 'Redes'
                    ],
                    [
                        'alias' => 'categorias',
                        'titulo' => 'Categorías'
                    ],
                    [
                        'alias' => 'servicios',
                        'titulo' => 'Servicios'
                    ],
                    [
                        'alias' => 'curriculum',
                        'titulo' => 'Currículum'
                    ],
                    [
                        'alias' => 'perfil',
                        'titulo' => 'Perfil'
                    ],
                    [
                        'alias' => 'hobies',
                        'titulo' => 'Hobbies'
                    ],
                    [
                        'alias' => 'contacto',
                        'titulo' => 'Contacto'
                    ],
                    [
                        'alias' => 'secciones',
                        'titulo' => 'Secciones'
                    ],
                    [
                        'alias' => 'navbar',
                        'titulo' => 'Navbar'
                    ],
                    [
                        'alias' => 'txtbanner',
                        'titulo' => 'Texto Banner'
                    ],
                    [
                        'alias' => 'clientes',
                        'titulo' => 'Clientes'
                    ],
                    [
                        'alias' => 'testimonios',
                        'titulo' => 'Testimonios'
                    ],
                    [
                        'alias' => 'blog',
                        'titulo' => 'Blog'
                    ],
                    [
                        'alias' => 'blogCat',
                        'titulo' => 'Categorías del Blog'
                    ],
                    [
                        'alias' => 'blogComm',
                        'titulo' => 'Comentarios del Blog'
                    ],
                    [
                        'alias' => 'blogComm2',
                        'titulo' => 'Comentarios del Blog (Versión 2)'
                    ],
                    [
                        'alias' => 'usuarios',
                        'titulo' => 'Usuarios'
                    ],
                    [
                        'alias' => 'roles',
                        'titulo' => 'Roles'
                    ],
                ];
            }

            // Extraer las secciones seleccionadas previamente para cada acción
            // Estas secciones se asignan a variables correspondientes a cada acción
            foreach ($actions as $action) {
                if (isset($roles->$action)) {
                    $this->data['selected' . ucfirst($action)] = explode(',', $roles->$action);
                } else {
                    $this->data['selected' . ucfirst($action)] = [];
                }
            }

            // Renderizar la vista
            $this->header();
            $this->sidebar();
            echo view('admin/edit-roles', $this->data);
            $this->footer();
        }
    }

    public function delete_roles($id) {
        // $this->valtoken();
        $token = $this->request->getCookie("token");

        // $this->data = [];
        if ($id) {
            $requestData = ["token" => $token]; // Datos para enviar a la API
            $delete_roles = json_decode(send_post($this->urlAPI . "delete/roles/" . $id, $requestData));

            if (isset($delete_roles->error)) {
                $this->data['error'] = $delete_roles->error;
            } else {
                // El proyecto se eliminó exitosamente
                $this->data['success'] = "Informacion de roles eliminada exitosamente";
            }
        }
        $this->get_roles();
    }

    // FIN CRUD ROLES

    private function valtoken() {
        $this->token = $this->request->getCookie("token");
        if (!$this->token) {
            header("Location: /admin/login");
            exit();
        }
        // debug($this->token,false);
        $checkToken = json_decode(send_post($this->urlAPI . "checktoken", ["token" => $this->token]));

        // debug($checkToken);

        if (isset($checkToken->error)) {
            header("Location: /admin/login");
            exit();
        } else {
            $this->user = $checkToken;
            // debug($this->user);
            $checkPerfil = json_decode(send_post($this->urlAPI . "perfil", ["token" => $this->token]));
            // debug(send_post($this->urlAPI . "perfil", ["token" => $token]));
            // debug($checkPerfil);
            if (!isset($checkPerfil->error)) {
                $this->user->informacion = $checkPerfil;
                // debug($this->user->informacion);
            }
        }

        // debug($checkToken);
    }
}

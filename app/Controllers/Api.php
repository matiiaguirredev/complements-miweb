<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Api extends BaseController {

    // esta es la unica manera de utilizar variables entre funciones , son lo mimso q metodos o funciones
    private $db = null;
    private $key = null;
    private $system = null;
    private $lang = "es";
    private $currentDate = null;
    private $user = null;
    private $activo = 0;
    private $captchaUrl = 'https://www.google.com/recaptcha/api/siteverify';

    private $perm = [
        "Root" => null,
        "Administrador" => null,
        "UsuarioEstandar" => null,
    ];

    public function __construct() {

        $this->db = \Config\Database::connect();

        $this->key = getenv('KEYENCRIPT');

        $this->system = (object)[
            "title" => getenv('GENERAL_TITLE'),
            "descrip" => getenv('GENERAL_DESCRIP'),
            "register" => filter_var(getenv('GENERAL_REGISTER'), FILTER_VALIDATE_BOOLEAN), // esto conviente el valor de env en booleano
        ];

        // debug($this->perm, false);
        foreach ($this->perm as $key => $value) {
            $this->perm[$key] = getenv("ROLE_ID_$key");
        }
        // debug($this->perm);

        // $this->currentDate = Time::now(); // funcion de codeige

        $hoy = getdate();
        // es para establecer fecha actual de toda la ejecucion, asi evitamos problemas.
        $this->currentDate = $hoy['year'] . '-' . $hoy['mon'] . '-' . $hoy['mday'] . ' ' . $hoy['hours'] . ':' . $hoy['minutes'] . ':' . $hoy['seconds'];
    }

    public function index() {
        // $this->valToken();
        // json_debug($this->user);
        echo view('admin/pages-404');
    }

    public function register() {
        // esto es lo primero que se tiene que hacer en un registro !
        // debug($this->system->register);
        if (!$this->system->register) {
            // el error es de registro desactiv
            // custom_error(207, $this->lang);
        }

        // $data = $this->request->getGetPost(); no sirve porque usamos base d datos estructurada mysql y no mongo.

        $require = [ // datos obligatorios
            "usuario" => "alias",
            "email" => "email",
            "pasw" => "password"
        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            } else { //  cuanod no te envian los datos requeridos se agrega en esta validacion // esto hace que si o si sea requerido
                $valRequire[] = $name; // lo pushea al ultimo
            }
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, $this->lang, $valRequire);
        }

        // almacenamiento temporario de los datos enviados por el form
        $usuario = $data['usuario'];
        $email = $data['email'];

        $query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '$usuario' OR email = '$email'"); // estamos chekeando si existe el usuario o emial
        $checkUser = $query->getResult();
        if ($checkUser) {
            custom_error(208, $this->lang);
        }

        $optionals = [ // datos opcionales 
            "nombre",
            "apellido",
        ];

        foreach ($optionals as $name) {
            $data[$name] = $this->request->getGetPost($name);
        }

        $data['pasw'] = encode($data['pasw'], $this->key);

        $insert = $this->db->table("usuarios")->insert($data);
        // $insert = true; // este era de test
        if (!$insert) {
            custom_error(204, $this->lang);
        }

        $id = $this->db->insertID(); // ultimo identificador insertado !
        // $id = 5; // este era un test

        $data['token'] = encode(json_encode([
            'id' => $id,
            'date' => $this->currentDate
        ]), $this->key);

        unset($data['pasw']);

        json_debug(array_merge(["id" => $id], $data));
    }

    public function login() {

        $require = [
            "usuario" => "alias",
            "pasw" => "password"
        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                // $data[$name] = validateValue($value, $type, $this->lang); esto se comento por que si ya se registro quiere decir que ya cumplio los parametros necesarios.
                $data[$name] = $value;
            } else {
                $valRequire[] = $name;
            }
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, $this->lang, $valRequire);
        }

        $usuario = $email = $data['usuario'];

        $query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '$usuario' OR email = '$email'");
        $checkUser = $query->getResult();

        if (!$checkUser) {
            custom_error(201, $this->lang);
        }

        $checkUser = $checkUser[0];

        $passw = decode($checkUser->pasw, $this->key);

        if ($passw != $data['pasw']) {
            custom_error(202, $this->lang);
        }

        $checkUser->token = encode(json_encode([
            'id' => $checkUser->id,
            'date' => $this->currentDate
        ]), $this->key);

        unset($checkUser->pasw); // la borramos por que no necesitamos enviarle a nadie la pasw / no se hace publica

        json_debug($checkUser);
    }

    public function checktoken() {
        $require = [
            "token" => "text",
        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            } else {
                $valRequire[] = $name;
            }
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, $this->lang, $valRequire);
        }

        $valtoken = json_decode(decode($data['token'], $this->key));

        if (!$valtoken) {
            custom_error(103, $this->lang, 'token');
        }

        // aqui va la validación de tiempo de token
        // debug($this->currentDate, false);

        $tokenTimestamp = strtotime($valtoken->date); // referencia al momento de creacion, la fecha que se puso en el momento de asignarlo
        $currentTimestamp = strtotime($this->currentDate); // este hace referencia al ahora mismo. a la facha y hora actual

        // Calcular la diferencia en segundos
        $difference = $currentTimestamp - $tokenTimestamp;

        $maxTime = getenv('SESION_TIME') * 60; // 60 minutos

        if ($difference > $maxTime) {
            // custom_error(502, $this->lang); esta comentado por el momento para que no expire el tiempo
        }

        $query = $this->db->query("SELECT usuarios.*, roles.nombre, roles.ver, roles.crear, roles.editar, roles.borrar FROM usuarios, roles WHERE usuarios.role_id = roles.id AND usuarios.id = '$valtoken->id'");
        $checkUser = $query->getResult(); // los datos del usuario

        if (!$checkUser) {
            custom_error(501, $this->lang);
        }

        $checkUser = $checkUser[0];
        // debug($checkUser);

        unset($checkUser->pasw);
        json_debug($checkUser);
        // $this->user = $checkUser;
    }

    // CRUD proyect
    public function create_proyect() {
        $this->valToken();

        // intentado poner los permisos
        $rolesAllowed = [
            $this->perm['Root'],
        ];

        if (!in_array($this->user->role_id, $rolesAllowed)) {
            // Sin permisos
            custom_error(403, "es", "create/proyect");
        }

        $require = [
            "nombre" => "text",
            "descripcion" => "text",
            "url" => "url",
            "cat_id" => "number",

        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            } else {
                $valRequire[] = $name;
            }
        }

        $data["img"] = $this->uploadImage("proyect", "img"); // nombre de carpeta y desp campo de bd 
        if (!$data["img"]) {
            // $valRequire[] = "img";
            $data["img"] = "300x300.jpg"; // aca esta opcional y tenemos una por defecto, si queremos obligatoria descomentar arriba.
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, "es", $valRequire);
        }

        $data["user_id"] = $this->user->id;
        $data["activo"] = ($this->request->getGetPost("activo")) ? 1 : 0;

        $insert = $this->db->table("proyect")->insert($data);
        if (!$insert) {
            custom_error(204, $this->lang);
        }

        $data["img"] = base_url() . "assets/images/proyect/" . $data["img"];

        $id = $this->db->insertID(); // ultimo identificador insertado !

        json_debug(array_merge(["id" => $id], $data));
    }

    public function get_proyect($id = null) {
        $this->variables();

        // $this->valToken(); // las unicas que no se pide el token son las consultas publicas,  login y registro

        $query = "SELECT * FROM proyect ";
        if ($id) { // esto se utilza para consultar 1 especifico
            $query .= "WHERE id = '$id'";
        }
        if ($this->activo) {
            $query .= ($id) ? " AND" : " WHERE";
            $query .= " activo = 1";
        }
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "proyect");
        }

        //esto es para agregar url a la imagen !
        foreach ($datos as $key => $value) {
            if ($value->img) {
                $datos[$key]->img = base_url() . "assets/images/proyect/" . $value->img;
            }
        }

        if ($id) {
            $datos = $datos[0];
        }

        json_debug($datos);
    }

    public function update_proyect($id) {
        $this->valToken();

        $query = "SELECT * FROM proyect WHERE id = '$id'";
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "proyect");
        }

        $datos = $datos[0];


        $require = [
            "nombre" => "text",
            "descripcion" => "text",
            "url" => "url",
            "cat_id" => "number",
        ];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            }
        }

        $data["img"] = $this->uploadImage("proyect", "img"); // nombre de carpeta y desp campo de bd 
        if (!$data["img"]) {
            // $valRequire[] = "img";
            $data["img"] = $datos->img;
        }

        $data["user_id"] = $this->user->id;
        $data["activo"] = ($this->request->getGetPost("activo")) ? 1 : 0;


        $update = $this->db->table("proyect")->update($data, ["id" => $id]); // ver query de mysql para entender bien cuales son los 2 paremetros q recibimos (set y where)
        if (!$update) {
            custom_error(506, $this->lang, "proyect");
        }

        $data["img"] = base_url() . "assets/images/proyect/" . $data["img"];

        json_debug(array_merge((array)$datos, $data));
    }

    public function delete_proyect($id) {

        $this->valToken(); // las unicas que no se pide el token son las consultas publicas,  login y registro

        $query = "SELECT * FROM proyect WHERE id = '$id'";
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "proyect");
        }

        $delete = $this->db->table("proyect")->delete(["id" => $id]);
        if (!$delete) {
            custom_error(507, $this->lang, "proyect");
        }

        if ($id) {
            $datos = $datos[0];
        }

        json_debug($datos);
    }
    // FIN CRUD proyect

    // CRUD USUARIOS

    public function create_usuarios() {
        $this->valToken();

        $require = [ // datos obligatorios
            "usuario" => "alias",
            "email" => "email",
            "pasw" => "password",
            "role_id" => "number",

        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            } else {
                $valRequire[] = $name;
            }
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, "es", $valRequire);
        }

        // $usuario = $data['usuario'];
        // $email = $data['email'];

        // $query = $this->db->query("SELECT * FROM usuarios WHERE usuario = '$usuario' OR email = '$email'"); // estamos chekeando si existe el usuario o emial
        // $checkUser = $query->getResult();
        // if ($checkUser) {
        //     custom_error(208, $this->lang);
        // }

        $usuario = $data['usuario'];
        $email = $data['email'];

        $query = $this->db->table('usuarios')
            ->where('usuario', $usuario)
            ->orWhere('email', $email)
            ->get();

        $checkUser = $query->getResult();

        if ($checkUser) {
            custom_error(208, $this->lang); // Error: El usuario o el email ya existen
        }


        $optionals = [ // datos opcionales 
            "nombre",
            "apellido",
        ];

        foreach ($optionals as $name) {
            $data[$name] = $this->request->getGetPost($name);
        }

        $data['pasw'] = encode($data['pasw'], $this->key);

        $data["activo"] = ($this->request->getGetPost("activo")) ? 1 : 0;

        $insert = $this->db->table("usuarios")->insert($data);
        if (!$insert) {
            custom_error(204, $this->lang);
        }

        $id = $this->db->insertID(); // ultimo identificador insertado !

        // $data['token'] = encode(json_encode([
        //     'id' => $id,
        //     'date' => $this->currentDate
        // ]), $this->key);

        unset($data['pasw']);

        json_debug(array_merge(["id" => $id], $data));
    }

    public function get_usuarios($id = null) {
        $this->variables();

        // esta hicimos con alberto, la de abajo es chatgpt
        $query = "SELECT usuarios.*, roles.nombre AS role_nombre FROM `usuarios`, roles WHERE 1=1";
        if ($id) { // esto se utilza para consultar 1 especifico
            $query .= " AND usuarios.id = '$id'";
        }
        if ($this->activo) {
            $query .= ($id) ? " AND" : "";
            $query .= " activo = 1";
        }

        $query .= " AND usuarios.role_id = roles.id AND usuarios.id <> 1 ORDER BY `usuarios`.`id` ASC";

        // devuelve esto
        // SELECT usuarios.*, roles.nombre AS role_nombre FROM `usuarios`, roles WHERE 1=1 AND usuarios.role_id = roles.id AND usuarios.id <> 1 ORDER BY `usuarios`.`id` ASC

        // json_debug($query);

        // $query = "SELECT usuarios.*, roles.nombre FROM usuarios INNER JOIN roles ON usuarios.role_id = roles.id WHERE usuarios.id <> 1";
        // if ($id) { // Esto se utiliza para consultar un usuario específico
        //     $query .= " AND usuarios.id = '$id'";
        // }

        // if ($this->activo) {
        //     $query .= " AND usuarios.activo = 1";
        // }

        // $query .= " ORDER BY usuarios.id ASC";


        // Ejecutar la consulta
        $query = $this->db->query($query);
        $datos = $query->getResult();

        // Manejo de error si no hay datos
        if (!$datos) {
            custom_error(504, $this->lang, "usuarios");
        }

        // Si se proporciona un id específico, devolver solo el primer resultado
        if ($id) {
            $datos = $datos[0];
        }

        // Devolver los datos en formato JSON
        json_debug($datos);
    }

    public function update_usuarios($id) {
        $this->valToken();

        $query = "SELECT usuarios.*, roles.nombre AS role_nombre FROM `usuarios`, roles WHERE 1=1";
        if ($id) { // esto se utilza para consultar 1 especifico
            $query .= " AND usuarios.id = '$id'";
        }
        if ($this->activo) {
            $query .= ($id) ? " AND" : "";
            $query .= " activo = 1";
        }

        $query .= " AND usuarios.role_id = roles.id AND usuarios.id <> 1 ORDER BY `usuarios`.`id` ASC";


        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "usuarios");
        }

        $datos = $datos[0]; // por que estamos seleccionadno desde un identificdor y siempre el resltado es unico 

        $require = [ // datos obligatorios
            "usuario" => "alias",
            "email" => "email",
            "pasw" => "password",
            "role_id" => "number",

        ];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            }
        }

        $optionals = [ // datos opcionales 
            "nombre",
            "apellido",
        ];

        // json_debug($this->request->getGetPost());

        if (!$this->request->getGetPost("notnull")) {
            foreach ($optionals as $name) {
                $data[$name] = $this->request->getGetPost($name);
            }
        }

        $data["activo"] = ($this->request->getGetPost("activo")) ? 1 : 0;
        $data["edit_at"] = $this->currentDate;

        // debug($this->request->getGetPost(), false);
        // debug($data);

        // data es un parametro y representa el set
        // luego separado por , tenemos el where
        $update = $this->db->table("usuarios")->update($data, ["id" => $id]); // ver query de mysql para entender bien cuales son los 2 paremetros q recibimos (set y where)
        // debug($datos);
        if (!$update) {
            custom_error(506, $this->lang, "usuarios");
        }

        json_debug(array_merge((array)$datos, $data));
    }

    public function delete_usuarios($id) {

        $this->valToken(); // las unicas que no se pide el token son las consultas publicas,  login y registro

        $query = "SELECT * FROM usuarios WHERE id = '$id'";
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "usuarios");
        }

        $delete = $this->db->table("usuarios")->delete(["id" => $id]);
        if (!$delete) {
            custom_error(507, $this->lang, "general");
        }

        if ($id) {
            $datos = $datos[0];
        }

        json_debug($datos);
    }

    // FIN CRUD USUARIOS

    // CRUD ROLES

    public function create_roles() {
        $this->valToken();

        $require = [ // datos obligatorios
            "nombre" => "text",
        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            } else {
                $valRequire[] = $name;
            }
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, "es", $valRequire);
        }

        $nombre = $data['nombre'];
        $query = $this->db->query("SELECT * FROM roles WHERE nombre = '$nombre'"); // estamos chekeando si existe el nombre
        $checkUser = $query->getResult();
        if ($checkUser) {
            custom_error(209, $this->lang);
        }

        $optionals = [ // datos opcionales 
            "descripcion",
            "ver",
            "crear",
            "editar",
            "borrar",
        ];

        foreach ($optionals as $name) {
            $data[$name] = $this->request->getGetPost($name);

            if (is_array($data[$name])) {
                $data[$name] = implode(',', $data[$name]);
            }
        }

        $data["activo"] = ($this->request->getGetPost("activo")) ? 1 : 0;

        $insert = $this->db->table("roles")->insert($data);
        if (!$insert) {
            custom_error(204, $this->lang);
        }

        $id = $this->db->insertID(); // ultimo identificador insertado !

        json_debug(array_merge(["id" => $id], $data));
    }

    public function get_roles($id = null) {
        $this->variables();
        // $this->valToken(); // las unicas que no se pide el token son las consultas publicas,  login y registro

        // $query = "SELECT * FROM secciones ";
        $query = "SELECT * FROM `roles` ";
        if ($id) { // esto se utilza para consultar 1 especifico
            $query .= "WHERE id = '$id'";
        }
        if ($this->activo) {
            $query .= ($id) ? " AND" : " WHERE";
            $query .= " activo = 1";
        }

        $query .= " ORDER BY `roles`.`id` ASC";
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "roles");
        }

        if ($id) {
            $datos = $datos[0];
        }

        json_debug($datos);
    }

    public function update_roles($id) {
        $this->valToken();

        $query = "SELECT * FROM roles WHERE id = '$id'";
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "roles");
        }

        $datos = $datos[0]; // por que estamos seleccionadno desde un identificdor y siempre el resltado es unico 

        $require = [ // datos obligatorios
            "nombre" => "text",
        ];


        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            }
        }

        $optionals = [ // datos opcionales 
            "descripcion",
            "ver",
            "crear",
            "editar",
            "borrar",
        ];

        // json_debug($this->request->getGetPost());

        if (!$this->request->getGetPost("notnull")) {
            foreach ($optionals as $name) {
                $data[$name] = $this->request->getGetPost($name);
            }
        }

        $data["activo"] = ($this->request->getGetPost("activo")) ? 1 : 0;
        // debug($this->request->getGetPost(), false);
        // debug($data);

        // data es un parametro y representa el set
        // luego separado por , tenemos el where
        $update = $this->db->table("roles")->update($data, ["id" => $id]); // ver query de mysql para entender bien cuales son los 2 paremetros q recibimos (set y where)
        // debug($datos);
        if (!$update) {
            custom_error(506, $this->lang, "roles");
        }

        json_debug(array_merge((array)$datos, $data));
    }

    public function delete_roles($id) {

        $this->valToken(); // las unicas que no se pide el token son las consultas publicas,  login y registro

        $query = "SELECT * FROM roles WHERE id = '$id'";
        $query = $this->db->query($query);
        $datos = $query->getResult();

        if (!$datos) {
            custom_error(504, $this->lang, "roles");
        }

        $delete = $this->db->table("roles")->delete(["id" => $id]);
        if (!$delete) {
            custom_error(507, $this->lang, "general");
        }

        if ($id) {
            $datos = $datos[0];
        }

        json_debug($datos);
    }

    // FIN CRUD ROLES

    public function mailing() {
        $this->valToken();

        $this->captchaUrl;

        $parametros = [
            "secret" => getenv('CAPTCHA_KEY'),
            "response" => $this->request->getGetPost("g-recaptcha-response"),
        ];

        $captcha = json_decode(send_post($this->captchaUrl, $parametros));
        // debug($this->request->getGetPost(), false);
        // debug($captcha);
        if (!$captcha->success) {
            custom_error(107, $this->lang);
        }

        $email = \Config\Services::email();

        // $email->setFrom('matiasagui93@gmail.com', 'Matias Aguirre');
        $email->setTo('mati_aa93@outlook.com');
        $email->setCC($this->request->getGetPost('email'));
        $email->setSubject('Contacto mi Web');

        // Construcción del mensaje con HTML
        $tabla = '
            <html>
                <head>
                    <style>
                        .table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        .table th, .table td {
                            padding: 8px;
                            text-align: left;
                            border: 1px solid #ddd;
                        }
                        .table th {
                            background-color: #f4f4f4;
                        }
                    </style>
                </head>
                <body>
                    <h1>Contacto Web</h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Nombre:</th>
                                <td>' . htmlspecialchars($this->request->getGetPost('name')) . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Email:</th>
                                <td>' . htmlspecialchars($this->request->getGetPost('email')) . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Asunto:</th>
                                <td>' . htmlspecialchars($this->request->getGetPost('subject')) . '</td>
                            </tr>
                            <tr>
                                <th scope="row">Mensaje:</th>
                                <td>' . htmlspecialchars($this->request->getGetPost('message')) . '</td>
                            </tr>
                        </tbody>
                    </table>
                </body>
            </html>';

        $email->setMessage($tabla);

        if (!$email->send()) {
            custom_error(108, $this->lang);
        }

        $data = [
            "success" => true,
            "name" => $this->request->getGetPost('name'),
            "email" => $this->request->getGetPost('email'),
            "subject" => $this->request->getGetPost('subject'),
            "message" => $this->request->getGetPost('message'),
        ];

        json_debug($data);
    }

    public function delete_img() {

        // Procesar los datos según sea necesario
        $require = [
            "seccion" => "text",
            "id" => "number",
        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $req[$name] = validateValue($value, $type, $this->lang);
            } else {
                $valRequire[] = $name;
            }
        }
        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, "es", $valRequire);
        }

        // $funcion = $this->request->getGetPost("funcion");
        $seccion = $req["seccion"];
        $id = $req["id"];

        $query = "SELECT * FROM $seccion WHERE id = '$id'";
        // debug($query);
        $query = $this->db->query($query);
        $datos = $query->getResult();
        // debug($datos);

        if (!$datos) {
            custom_error(504, $this->lang, $seccion);
        }

        $datos = $datos[0];
        $data = [];
        $img = null; // esta variable es para guardar el valor la img para envair a la papelera

        if (isset($datos->bg_img)) {
            $img = $datos->bg_img;
            $data['bg_img'] = null;
        }

        if (isset($datos->img)) {
            $img = $datos->img;
            $data['img'] = null;
        }

        if (isset($datos->img_fondo)) {
            $img = $datos->img_fondo;
            $data['img_fondo'] = null;
        }

        if (isset($datos->img_proyecto)) {
            $img = $datos->img_proyecto;
            $data['img_proyecto'] = null;
        }

        if (isset($datos->{'img_' . $seccion})) {
            $img = $datos->{'img_' . $seccion};
            $data['img_' . $seccion] = null;
        }

        if ($data) {
            // en el update
            // data es un parametro y representa el set
            // luego separado por , tenemos el where
            $update = $this->db->table($seccion)->update($data, ["id" => $id]);
            if (!$update) {
                custom_error(507, $this->lang, $seccion);
            }
        }

        if ($img) {
            $this->TrashFIle($seccion, $img);
        }

        json_debug(array_merge((array)$datos, $data));
    }

    public function delete_img_perfil() {
        // Obtener la ruta completa de la imagen enviada por el cliente
        $rutaCompleta = $this->request->getPost('ruta');
        
        // Validación sencilla para asegurar que la ruta esté presente
        if (!$rutaCompleta) {
            return json_debug(['error' => 'La ruta de la imagen es requerida.'], 400);
        }
    
        // Extraer el nombre del archivo desde la ruta completa (obtenemos solo el nombre de la imagen)
        $nombreArchivo = basename($rutaCompleta);
    
        // Tabla de perfil y columnas a procesar (solo las imágenes relacionadas con el perfil)
        $tabla = 'perfil';
        $columnas = ['img', 'img_fondo'];
    
        // Buscar en la base de datos si alguna de las columnas tiene este nombre de archivo
        $query = $this->db->table($tabla)
            ->groupStart()
            ->whereIn($columnas[0], [$nombreArchivo]) // Verifica si el nombre coincide con 'img'
            ->orWhereIn($columnas[1], [$nombreArchivo]) // Verifica si el nombre coincide con 'img_fondo'
            ->groupEnd()
            ->get();
    
        // Comprobamos si se encontró algún registro
        $registro = $query->getRow();
    
        if (!$registro) {
            return json_debug(['error' => 'La imagen no está registrada en la base de datos.'], 404);
        }
    
        // Determinar qué columna corresponde al archivo a eliminar
        $columnaAActualizar = null;
        if ($registro->{$columnas[0]} === $nombreArchivo) {
            $columnaAActualizar = $columnas[0]; // La imagen corresponde a 'img'
        } elseif ($registro->{$columnas[1]} === $nombreArchivo) {
            $columnaAActualizar = $columnas[1]; // La imagen corresponde a 'img_fondo'
        }
    
        if (!$columnaAActualizar) {
            return json_debug(['error' => 'No se pudo determinar la columna de la imagen.'], 500);
        }
    
        // Eliminar la referencia en la base de datos (actualizamos la columna con NULL)
        $actualizacion = $this->db->table($tabla)
            ->where('id', $registro->id)
            ->update([$columnaAActualizar => null]);
    
        if (!$actualizacion) {
            return json_debug(['error' => 'No se pudo actualizar la base de datos.'], 500);
        }
    
        // Construir la ruta completa del archivo en el servidor
        $rutaServidor = FCPATH . 'assets/images/perfil/' . $nombreArchivo;
    
        // Verificar que el archivo exista en el servidor
        if (!file_exists($rutaServidor)) {
            return json_debug(['warning' => 'El archivo no existe en el servidor, pero la base de datos fue actualizada.'], 200);
        }
    
        // Intentar eliminar el archivo del servidor
        if (unlink($rutaServidor)) {
            return json_debug(['success' => 'Imagen eliminada correctamente.'], 200);
        } else {
            return json_debug(['error' => 'La base de datos se actualizó, pero no se pudo eliminar el archivo.'], 500);
        }
    }

    public function bgimg($width, $height, $color = '808080') {
        // Verificar que width y height sean números válidos
        if (!is_numeric($width) || !is_numeric($height) || $width <= 0 || $height <= 0) {
            return $this->response->setStatusCode(400)->setBody('Invalid dimensions');
        }

        // Eliminar el símbolo # si está presente en el color
        $color = str_replace('#', '', $color);

        // Verificar que el color tenga exactamente 6 caracteres
        if (strlen($color) !== 6) {
            return $this->response->setStatusCode(400)->setBody('Invalid color format');
        }

        // Convertir el color hexadecimal a RGB
        $red = hexdec(substr($color, 0, 2));
        $green = hexdec(substr($color, 2, 2));
        $blue = hexdec(substr($color, 4, 2));

        // Crear una imagen en blanco
        $image = imagecreatetruecolor($width, $height);

        // Asignar el color a la imagen
        $backgroundColor = imagecolorallocate($image, $red, $green, $blue);
        imagefill($image, 0, 0, $backgroundColor);

        // Enviar los encabezados adecuados para que el navegador sepa que es una imagen
        header('Content-Type: image/png');

        // Generar la imagen
        imagepng($image);

        // Liberar la memoria
        imagedestroy($image);

        // Detener la ejecución para no enviar datos adicionales después de la imagen
        exit;
    }

    private function valToken() {
        $require = [
            "token" => "text",
        ];

        $valRequire = [];

        foreach ($require as $name => $type) {
            $value = $this->request->getGetPost($name);
            if ($value) {
                $data[$name] = validateValue($value, $type, $this->lang);
            } else {
                $valRequire[] = $name;
            }
        }

        if ($valRequire) {
            // validar error que te faltan datos
            custom_error(101, $this->lang, $valRequire);
        }

        $valtoken = json_decode(decode($data['token'], $this->key)); // decodificamos y validamos el token
        // debug($valtoken, false);

        if (!$valtoken) {
            custom_error(103, $this->lang, 'token'); // si el token no tiene formato correcto
        }

        // aqui va la validación de tiempo de token
        // debug($this->currentDate, false);

        $tokenTimestamp = strtotime($valtoken->date); // referencia al momento de creacion, la fecha que se puso en el momento de asignarlo
        $currentTimestamp = strtotime($this->currentDate); // este hace referencia al ahora mismo. a la facha y hora actual

        // Calcular la diferencia en segundos
        $difference = $currentTimestamp - $tokenTimestamp;

        $maxTime = getenv('SESION_TIME') * 60; // 60 minutos // esta funcion es para traer valores del arch env

        if ($difference > $maxTime) {
            // custom_error(502, $this->lang); esta comentado por el momento para que no expire el tiempo
        }

        $query = $this->db->query("SELECT * FROM usuarios WHERE id = '$valtoken->id'");
        $checkUser = $query->getResult();
        if (!$checkUser) {
            custom_error(501, $this->lang); // si el usuario no existe
        }

        $checkUser = $checkUser[0];

        unset($checkUser->pasw);
        $this->user = $checkUser;
    }

    private function uploadImage($carpeta, $inputName) {
        $rutaCarpeta = 'assets/images/' . $carpeta;

        // Obtener el archivo cargado
        $file = $this->request->getFile($inputName);

        if (!$file) {
            return false;
        }

        if (!file_exists($rutaCarpeta)) {
            // Intentar crear la carpeta con permisos
            if (!mkdir($rutaCarpeta)) {
                // No se pudo crear la carpeta, devuelve false
                return false;
            }
        }

        // debug($file, false);
        // show_error($file);
        // Verificar si el archivo ha sido cargado
        if (!$file->isValid()) {
            return false;
        }

        // Generar un nombre encriptado para el archivo con extension
        $nombreEncriptado = md5($file->getName() . microtime()) . '.' . $file->getClientExtension();

        // Mover el archivo a la carpeta especificada
        $file->move($rutaCarpeta, $nombreEncriptado);


        // Devolver el nombre encriptado del archivo
        return $nombreEncriptado;
    }

    private function TrashFIle($carpeta, $name) {
        // Verificar si el nombre del archivo es válido
        if (empty($name)) {
            return false;
        }

        // Rutas de las carpetas
        $carpetaOrigen = 'assets/images/' . $carpeta . '/';
        $carpetaDestino = 'assets/images/papelera/';

        // Ruta completa de los archivos
        $rutaArchivoOrigen = $carpetaOrigen . $name;
        $rutaArchivoDestino = $carpetaDestino . $name;

        // Verificar si el archivo existe en la carpeta de origen
        if (file_exists($rutaArchivoOrigen)) {
            // Mover el archivo a la carpeta de destino
            if (rename($rutaArchivoOrigen, $rutaArchivoDestino)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false; // El archivo no existe en la carpeta de origen
        }
    }

    private function variables() {
        $this->activo = $this->request->getGetPost('activo');
        if ($this->activo && $this->activo != 1) {
            $this->activo = 1;
        }
    }
}

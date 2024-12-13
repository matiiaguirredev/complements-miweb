<?php

namespace App\Controllers;

class Web extends BaseController {

    private $db = null;
    private $urlAPI = "http://web-landing/api/";
    private $data = null;
    private $user = null;
    private $token = null;
    private $lang = "es";


    public function __construct() {

        $this->db = \Config\Database::connect();
    }

    public function pages_404() {
        echo view('web/pages-404');
    }

    public function navbar() {

        $this->data['secciones'] = [];
        $secciones = json_decode(send_post($this->urlAPI . "secciones?activo=1")); //["token" => $token]
        // debug($secciones, false);
        if (isset($secciones->error)) {
            $this->data['error'] = $secciones->error;
        } else {
            $this->data['secciones'] = $secciones;
        }
        echo view('web/navbar', $this->data);
    }

    private function header() {
        echo view('header', $this->data);
    }

    private function footer() {
        echo view('footer', $this->data);
    }

    public function index() {
        $this->navbar();

        $this->data['perfil'] = [];
        $usuario = json_decode(send_post($this->urlAPI . "login", ["usuario" => "matias", "pasw" => "A123456789*"]));
        // debug($usuario);
        if (isset($usuario->error)) {
            $this->data['error'] = $usuario->error;
        } else {
            $perfil = json_decode(send_post($this->urlAPI . "perfil", ["token" => $usuario->token]));
            // debug($perfil);
            $this->data['perfil'] = $perfil;
            $this->data['perfil']->email = $usuario->email;
        }

        $this->data['redes'] = [];
        $redes = json_decode(send_post($this->urlAPI . "redes?activo=1")); //["token" => $token]
        // debug($redes, false);
        if (isset($redes->error)) {
            $this->data['error'] = $redes->error;
        } else {
            $this->data['redes'] = $redes;
        }

        $this->data['lenguajes'] = [];
        $lenguaje = json_decode(send_post($this->urlAPI . "lenguaje?activo=1"));
        // debug($lenguaje);
        if (isset($lenguaje->error)) {
            $this->data['error'] = $lenguaje->error;
        } else {
            $array_dividido = array_chunk($lenguaje, ceil(count($lenguaje) / 2));
            $this->data['lenguajesDiv'] = $array_dividido;
            $this->data['lenguajes'] = $lenguaje;
        }


        $this->data['secciones'] = [];
        $secciones = json_decode(send_post($this->urlAPI . "secciones?activo=1")); //["token" => $token]
        // debug($secciones, false);
        if (isset($secciones->error)) {
            $this->data['error'] = $secciones->error;
        } else {
            $this->data['secciones'] = $secciones;
        }

        $this->header();
        echo view('index', $this->data);
        // debug($secciones, false);

        foreach ($secciones as $secc) {
            // debug($secc);
            if (isset($secc->alias)) {
                $this->data["titulos"] = ($secc->titulos) ?? null;
                $this->data["sub_titulo"] = ($secc->sub_titulo) ?? null;
                $this->data["descripciones"] = ($secc->descripciones) ?? null;
                $this->data["img"] = ($secc->img) ?? null;
                $this->data["bg_color"] = ($secc->bg_color) ?? null;

                /* debug($secc->alias, false); */
                switch ($secc->alias) {
                    case "acerca":
                        // debug($secc, false);
                        $this->aboutmearea();
                        break;
                    case "servicios":
                        $this->servicesarea();
                        break;
                    case "clientes":
                        $this->clientes();
                        break;
                    case "curriculum":
                        $this->curriculum();
                        break;
                    case "proyectos":
                        $this->portfolioarea();
                        break;
                    case "separador":
                        $this->separador();
                        break;
                    case "blog":
                        $this->blog();
                        break;
                    case "testimonios":
                        $this->testimonials();
                        break;
                    case "contactame":
                        $this->contact();
                        break;
                }
            }
        }

        $this->footer();
    }

    public function single_blog($id) {

        // $postData = $_POST;
        // $getData = $_GET;
        // $requestData = $_REQUEST;

        // // Para debuggear los datos recibidos
        // debug([
        //     "post" => $postData,
        //     "get" => $getData,
        //     "request" => $requestData,
        // ]);


        $token = $this->request->getCookie("token");

        $this->data = [];

        $this->header();
        // Procesar el formulario de envío de comentarios
        // debug($this->request->getPost(),false);
        if ($this->request->getGetPost()) {
            if (!$token) {
                $loginData = [
                    "usuario" => "web",
                    "pasw" => "A123456789*"
                ];
                $login = json_decode(send_post($this->urlAPI . "login", $loginData));

                if (isset($login->error)) {
                    $this->data['error'] = $login->error;
                } else {
                    $token = $login->token;
                    // debug($token);
                }
            }

            $requestData = array_merge($this->request->getGetPost(), ["token" => $token, "id_post" => $id]);
            // debug($requestData);
            $create_blogComm2 = json_decode(send_post($this->urlAPI . "create/blogComm2", $requestData));
            // debug($create_blogComm2);
            if (isset($create_blogComm2->error)) {
                $this->data['error'] = $create_blogComm2->error;
            } else {
                $this->data['success'] = "Información de comentarios de blog creada exitosamente";
            }
        }

        // Obtener todos los comentarios
        $blogComm2List = json_decode(send_post($this->urlAPI . "blogComm2", ["token" => $token]));
        if (isset($blogComm2List->error)) {
            $this->data['error'] = $blogComm2List->error;
        } else {
            // Filtrar los comentarios que corresponden al post actual
            $filteredComments = array_filter($blogComm2List, function ($bc2) use ($id) {
                return $bc2->id_post == $id && $bc2->activo == 1;
            });

            // Contar los comentarios filtrados
            $numComm = count($filteredComments);

            $this->data['blogComm2'] = $filteredComments;
            $this->data['numComm'] = $numComm;
        }

        // HASTA ACA ESTOY INVENTANDO


        $this->data['blog'] = [];
        $blog = json_decode(send_post($this->urlAPI . "blog/" . $id . '?activo=1', ["token" => $token]));
        // debug($blog);
        if (isset($blog->error)) {
            $this->data['error'] = $blog->error;
        } else {
            $this->data['blog'] = $blog;
        }

        // si no hay blog activo me lleva a esta vista, ya que si no salia 
        // error por las variables y tmb le tuve q  poner un ?activo=1 
        // sino seguian con acceso al blog aun cuando no estaba activo
        if (!$this->data['blog']) {
            return $this->pages_404();
        } else {
            $this->navbar();
        }

        $this->data['blogComm'] = [];
        $blogComm = json_decode(send_post($this->urlAPI . "blogComm", ["token" => $token]));
        if (isset($blogComm->error)) {
            $this->data['error'] = $blogComm->error;
        } else {
            $this->data['blogComm'] = $blogComm;
        }

        $this->data['blogCat'] = [];
        $blogCat = json_decode(send_post($this->urlAPI . "blogCat", ["token" => $token]));
        // debug($blogCat, false);
        if (isset($blogCat->error)) {
            $this->data['error'] = $blogCat->error;
        } else {
            $this->data['blogCat'] = $blogCat;
        }

        $this->data['redes'] = [];
        $redes = json_decode(send_post($this->urlAPI . "redes", ["token" => $token]));
        if (isset($redes->error)) {
            $this->data['error'] = $redes->error;
        } else {
            $this->data['redes'] = $redes;
        }


        $this->data['user'] = [];
        $this->token = $this->request->getCookie("token");
        // debug($this->token = $this->request->getCookie("token"));
        // debug($this->token);
        $checkToken = json_decode(send_post($this->urlAPI . "checktoken", ["token" => $this->token]));
        // debug($checkToken); // borrar esto
        // debug($this->urlAPI ."checkToken", false);

        // if (isset($checkToken->error)) {
        //     header("Location: /admin/login");
        //     exit();
        // } else {
        $this->user = $checkToken;
        // debug($this->user, false);

        $checkPerfil = json_decode(send_post($this->urlAPI . "perfil", ["token" => $this->token]));
        // debug(send_post($this->urlAPI . "perfil", ["token" => $token]));
        // debug($checkPerfil);

        if (!isset($checkPerfil->error)) {
            $this->user->informacion = $checkPerfil;
        }
        // debug($this->user);
        // } esto viene del if arriba comentado

        // Aquí asignamos $this->user a $this->data['user']
        $this->data['user'] = $this->user;
        // debug($this->data['user']);

        echo view('web/single-blog', $this->data);
        $this->footer();
    }


    //estan en orden como iria la web original !!!!
    private function aboutmearea() {

        $this->data['lenguajes'] = [];
        $lenguaje = json_decode(send_post($this->urlAPI . "lenguaje?activo=1"));
        // debug($lenguaje, false);
        if (isset($lenguaje->error)) {
            $this->data['error'] = $lenguaje->error;
        } else {
            $array_dividido = array_chunk($lenguaje, ceil(count($lenguaje) / 2));
            $this->data['lenguajesDiv'] = $array_dividido;
            $this->data['lenguajes'] = $lenguaje;
        }

        $this->data['hobies'] = [];
        $hobies = json_decode(send_post($this->urlAPI . "hobies?activo=1")); //["token" => $token]
        // debug($hobies, false);
        if (isset($hobies->error)) {
            $this->data['error'] = $hobies->error;
        } else {
            $this->data['hobies'] = $hobies;
        }

        // if (!empty($this->data['clientes'])) {
        echo view('web/about-me-area', $this->data);
        // }
    }

    private function servicesarea() {
        $this->data['servicios'] = [];
        $servicios = json_decode(send_post($this->urlAPI . "servicios?activo=1"));
        if (isset($servicios->error)) {
            $this->data['error'] = $servicios->error;
        } else {
            $this->data['servicios'] = $servicios;
        }

        if (!empty($this->data['servicios'])) {
            echo view('web/services-area', $this->data);
        }
    }

    private function clientes() {

        $this->data['clientes'] = [];
        $clientes = json_decode(send_post($this->urlAPI . "clientes?activo=1"));
        if (isset($clientes->error)) {
            $this->data['error'] = $clientes->error;
        } else {
            $this->data['clientes'] = $clientes;
        }

        if (!empty($this->data['clientes'])) {
            echo view('web/fun-facts-area', $this->data);
        }
    }

    private function curriculum() {
        $this->data['curriculum'] = [];
        $curriculum = json_decode(send_post($this->urlAPI . "curriculum?activo=1"));
        if (isset($curriculum->error)) {
            $this->data['error'] = $curriculum->error;
        } else {
            $this->data['curriculum'] = $curriculum;
        }

        if (!empty($this->data['curriculum'])) {
            echo view('web/resume-area', $this->data);
        }
    }

    private function portfolioarea() {

        $this->data['categorias'] = [];
        $categorias = json_decode(send_post($this->urlAPI . "categorias?activo=1"));
        if (isset($categorias->error)) {
            $this->data['error'] = $categorias->error;
        } else {
            $this->data['categorias'] = $categorias;
        }

        $this->data['proyectos'] = [];
        $proyect = json_decode(send_post($this->urlAPI . "proyect?activo=1"));
        if (isset($proyect->error)) {
            $this->data['error'] = $proyect->error;
        } else {
            $this->data['proyectos'] = $proyect;
        }

        if (!empty($this->data['categorias']) && !empty($this->data['proyectos'])) {
            echo view('web/portfolio-area', $this->data);
        }
    }

    private function separador() {
        echo view('web/hire-me', $this->data);
    }

    private function blog() {
        $this->data['blog'] = [];
        $blog = json_decode(send_post($this->urlAPI . "blog?activo=1"));
        // debug($blog, false);
        if (isset($blog->error)) {
            $this->data['error'] = $blog->error;
        } else {
            $this->data['blog'] = $blog;
        }

        if (!empty($this->data['blog'])) {
            echo view('web/blog', $this->data);
        }
    } // aca sigue la de single blog que esta arriba por que es publica

    private function testimonials() {
        $this->data['testimonios'] = [];
        $testimonios = json_decode(send_post($this->urlAPI . "testimonios?activo=1")); //["token" => $token]
        // debug($testimonios, false);
        if (isset($testimonios->error)) {
            $this->data['error'] = $testimonios->error;
        } else {
            $this->data['testimonios'] = $testimonios;
        }

        if (!empty($this->data['testimonios'])) {
            echo view('web/testimonials', $this->data);
        }
    }

    private function contact() {

        $token = $this->request->getCookie("token");
        // debug($token);
        if ($this->request->getGetPost()) {
            // debug($this->request->getGetPost());
            if (!$token) {
                $loginData = [
                    "usuario" => "web",
                    "pasw" => "A123456789*"
                ];
                $login = json_decode(send_post($this->urlAPI . "login", $loginData));

                if (isset($login->error)) {
                    $this->data['error'] = $login->error;
                } else {
                    $token = $login->token;
                    // debug($token);
                }
            }

            // debug($this->request->getGetPost());
            $requestData = array_merge($this->request->getGetPost(), ["token" => $token]);
            // debug($requestData);
            $mailing = json_decode(send_post($this->urlAPI . "mailing", $requestData));
            // debug($mailing);
            if (isset($mailing->error)) {
                $this->data['error'] = $mailing->error;
            } else {
                $this->data['success'] = "Mensaje enviado satisfactoriamente";
            }

        }



        $this->data['contacto'] = [];
        $contacto = json_decode(send_post($this->urlAPI . "contacto?activo=1")); //["token" => $token]
        // debug($contacto, false);
        if (isset($contacto->error)) {
            $this->data['error'] = $contacto->error;
        } else {
            $this->data['contacto'] = $contacto;
        }

        if (!empty($this->data['contacto'])) {
            echo view('web/contact', $this->data);
        }
    }

    //  finish el orden de la web !!!!

    public function test() {

        // debug($this->db);

        $query   = $this->db->query('SELECT * FROM hola');
        $results = $query->getResult();

        json_debug($results);

        // foreach ($results as $row) {
        //     echo $row->title;
        //     echo $row->name;
        //     echo $row->email;
        // }

        echo 'Total Results: ' . count($results);
    }
}

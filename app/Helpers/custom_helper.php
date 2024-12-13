<?php

use Config\Services;

if (!function_exists('show_error')) {
    function show_error($message, $statusCode = 500) {
        \CodeIgniter\Config\Services::response()
            ->setStatusCode($statusCode)
            ->setJSON(['error' => $message])
            ->send();
        exit;
    }
}

if (!function_exists('debug')) {
    function debug($var, $stop = true) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";

        $stop && exit;
    }
}

if (!function_exists('json_debug')) {
    function json_debug($var, $statusCode = 200) {
        \CodeIgniter\Config\Services::response()
            ->setStatusCode($statusCode)
            ->setJSON($var)
            ->send();
        exit;
    }
}

if (!function_exists('print_j')) {
    function print_j($data, $sucess = false, $return = false) {

        // Asigna valores predeterminados si no existen
        $data += ['success' => (bool) $sucess, 'answer' => $data];

        // Reorganiza el array para que 'success' siempre sea la primera clave
        $data = ['success' => $data['success'], 'answer' => $data['answer']];

        // Obtiene la instancia de Response de CodeIgniter
        $response = Services::response();
        $response->setHeader('Content-Type', 'application/json; charset=UTF-8');
        if ($data['success']) {
            $response->setStatusCode(200);
        } else {
            $response->setStatusCode(500);
        }
        // Imprime o devuelve
        if ($return) {
            return $data;
        } else {
            echo json_encode($data);
        }
    }
}

if (!function_exists('encode')) {
    function encode($data, $key) {
        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = openssl_random_pseudo_bytes($ivSize);

        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);

        return base64_encode($iv . $encrypted);
    }
}

if (!function_exists('decode')) {
    function decode($data, $key) {
        $data = base64_decode($data);
        if ($data === false) {
            return false; // Error decoding base64
        }

        $ivSize = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivSize);
        if (strlen($iv) !== $ivSize) {
            return false; // IV size mismatch
        }

        $data = substr($data, $ivSize);

        $decrypted = openssl_decrypt($data, 'aes-256-cbc', $key, 0, $iv);

        return $decrypted !== false ? $decrypted : false;
    }
}

if (!function_exists('send_post')) {
    function send_post($url, $params = []) {
        $ch = curl_init($url);

        // Configurar opciones generales de cURL
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Configurar opciones específicas para manejar HTTPS
        if (substr($url, 0, 5) === 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        // json_debug(curl_getinfo($ch));
        $response = curl_exec($ch);

        if ($response === false) {
            // Manejar el error de cURL según tus necesidades
            return curl_error($ch);
        }

        curl_close($ch);

        return $response;
    }
}

if (!function_exists('custom_error')) {
    function custom_error($code, $language = 'en', $variables = [], $responseCode = 500) { // si los parametros tiene algo asignado son opcionales
        // Definir mensajes de error según el idioma y código
        $variablesText = $variables;
        if (is_array($variables)) {
            $variablesText = implode(', ', $variables);
        }
        $requestUri = $_SERVER['REQUEST_URI'];
        $path = parse_url($requestUri, PHP_URL_PATH);

        $errorMessages = [
            'en' => [
                //Global Errors
                '100' => 'Something went wrong.',
                '101' => "The following variables were not sent: $variablesText.",
                '102' => "Invalid data format. Please ensure that $variablesText is provided as an array.",
                '103' => "Incorrect format or value for $variablesText.",
                '104' => "Invalid String format for $variablesText.",
                '105' => "Invalid Integer format for $variablesText.",
                '106' => "Invalid Array format for $variablesText.",
                '107' => "reCAPTCHA verification failed. Please try again.",
                '108' => "Email could not be sent.",


                //User Errors
                '200' => 'Your session has expired. Please log in again.',
                '201' => 'Username or email not registered.',
                '202' => 'Incorrect password.',
                '203' => 'Error retrieving user information. Please try again.',
                '204' => 'Error registering user. Please try again.',
                '205' => "The following variables have already been used: $variablesText.",
                '206' => "The user '$variablesText' is currently inactive. Please contact support for assistance.",
                '207' => 'User registration is disabled. Please contact the administrator.',
                '208' => 'Username or email already registered.',
                '209' => 'Role already registered.',

                //Server Errors
                '403' => "You do not have permission to use the '$variablesText' function.",
                '404' => "The page at the path '$path' was not found.",
                '405' => "Basic Auth credentials not provided.",
                '406' => "Basic Auth credentials incorrect or invalid.",
                '500' => 'Internal server error.',
                '501' => "Invalid System Token. Unauthorized access. Please contact the developer.",
                '502' => "Expired System Token. Unauthorized access. Please contact the developer.",
                '503' => 'Invalid user role: The specified user role does not exist.',
                '504' => "No data found for '$variablesText'. Ensure that the requested data is available by adding corresponding entries and try again.",
                '505' => "Error inserting data for $variablesText. Please check the provided information and try again.",
                '506' => "Error editing data for $variablesText. Please verify the provided information and try again.",
                '507' => "Error deleting data for $variablesText. Please check the provided information and try again.",

                //Values Error
                '600' => 'Invalid value: The provided value is not a valid text.',
                '601' => 'Invalid password: The password must be at least 8 characters long and contain at least 1 special character.',
                '602' => 'Invalid phone number: The provided value is not a valid phone number.',
                '603' => 'Invalid URL: The provided value is not a valid URL.',
                '604' => 'Invalid email: The provided value is not a valid email address.',
                '605' => 'Invalid number: The provided value is not a valid number.',
                '606' => 'Invalid value: Should be a text without spaces and in lowercase.',
            ],
            'es' => [
                //Global Errors
                '100' => 'Algo salió mal.',
                '101' => "No se enviaron las siguientes variables: $variablesText.",
                '102' => "Formato de datos no válido. Asegúrate de que $variablesText se proporcione como un array.",
                '103' => "Formato o valor incorrecto para $variablesText.",
                '104' => "Formato de String no válido para $variablesText.",
                '105' => "Formato de Integer no válido para $variablesText.",
                '106' => "Formato de Array no válido para $variablesText.",
                '107' => "No se pudo verificar reCAPTCHA. Por favor, intenta nuevamente.",
                '108' => "No se pudo enviar el correo electrónico.",

                //User Errors
                '200' => 'Tu sesión ha expirado. Por favor, inicia sesión nuevamente.',
                '201' => 'Nombre de usuario o correo electrónico no registrados.',
                '202' => 'Contraseña incorrecta.',
                '203' => 'Error al obtener información del usuario. Por favor, inténtalo de nuevo.',
                '204' => 'Error al registrar usuario. Por favor, inténtalo de nuevo.',
                '205' => "Las siguientes variables ya se han utilizado: $variablesText.",
                '206' => "El usuario '$variablesText' está inactivo actualmente. Por favor, comunícate con soporte para obtener ayuda.",
                '207' => 'El registro de usuarios está deshabilitado. Ponte en contacto con el administrador.',
                '208' => 'Nombre de usuario o correo electrónico ya registrados.',
                '209' => 'Rol ya registrados.',

                //Server Errors
                '403' => "No tienes permiso para usar la función '$variablesText'.",
                '404' => "La página en la ruta '$path' no se encontró.",
                '405' => "Credenciales de Basic Auth no proporcionadas.",
                '406' => "Credenciales de Basic Auth incorrectas o no válidas.",
                '500' => 'Error interno del servidor.',
                '501' => "System Token no válido. Acceso no autorizado. Por favor, ponte en contacto con el desarrollador.",
                '502' => "System Token expirado. Acceso no autorizado. Por favor, ponte en contacto con el desarrollador.",
                '503' => 'Rol de usuario no válido: El rol de usuario especificado no existe.',
                '504' => "No se encontraron datos para $variablesText. Asegúrate de que los datos solicitados estén disponibles agregando las entradas correspondientes e inténtalo nuevamente.",
                '505' => "Error al insertar datos para $variablesText. Verifica la información proporcionada e inténtalo nuevamente.",
                '506' => "Error al editar datos para $variablesText. Verifica la información proporcionada e inténtalo nuevamente.",
                '507' => "Error al eliminar datos para $variablesText. Verifica la información proporcionada e inténtalo nuevamente.",

                //Values Error 
                '600' => 'Valor no válido: El valor proporcionado no es un texto válido.',
                '601' => 'Contraseña no válida: La contraseña debe tener al menos 8 caracteres y contener al menos 1 caracter especial.',
                '602' => 'Número de teléfono no válido: El valor proporcionado no es un número de teléfono válido.',
                '603' => 'URL no válida: El valor proporcionado no es una URL válida.',
                '604' => 'Email no válido: El valor proporcionado no es una dirección de correo electrónico válida.',
                '605' => 'Número no válido: El valor proporcionado no es un número válido.',
                '606' => 'Valor no válido: Debe ser un texto sin espacios y en minúsculas.',
            ],
        ];

        // Verificar si el idioma proporcionado existe, de lo contrario, usar inglés como predeterminado
        $language = array_key_exists($language, $errorMessages) ? $language : 'en';

        // Obtener el mensaje de error según el código y el idioma
        $errorMessage = isset($errorMessages[$language][$code]) ? $errorMessages[$language][$code] : "Unknown error.";

        //Concatena el mensaje de error con el Código de mismo
        $errorMessage = "Error $code: $errorMessage";

        show_error($errorMessage, $responseCode);
    }
}

if (!function_exists('validateValue')) {
    function validateValue($value, $type, $lang = 'en') {
        $error = false;
        switch ($type) {
            case 'text':
                if (!is_string($value)) {
                    $error = 600;
                }
                break;
            case 'password':
                if (strlen($value) < 8 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $value)) {
                    $error = 601;
                }
                break;
            case 'tel':
                if (!preg_match('/^\+?[0-9]+$/', $value)) {
                    $error = 602;
                }
                break;
            case 'url':
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    $error = 603;
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $error = 604;
                }
                break;
            case 'number':
                if (!is_numeric($value)) {
                    $error = 605;
                }
                break;
            case 'alias':
                if (!is_string($value)) {
                    $error = 606;
                } else {
                    $value = strtolower(str_replace(' ', '-', $value));
                }
                break;
                // default:
                // custom_error(606, $lang);
        }
        if ($error) {
            custom_error($error, $lang);
        }
        return $value;
    }
}

if (!function_exists('array_count_by_condition')) {
    function array_count_by_condition($array, $userAlias, $sex = null, $sport = null) {
        return count(array_filter($array, function ($person) use ($userAlias, $sex, $sport) {
            return ($person->user_alias == $userAlias) &&
                (!$sex || $person->sex == $sex) &&
                (!$sport || $person->sport == $sport);
        }));
    }
}

if (!function_exists('dia_mes')) {
    function dia_mes($fechaOriginal) {
        // Crear un objeto DateTime a partir de la cadena de fecha
        $fecha = new DateTime($fechaOriginal);

        // Definir un arreglo de meses en español
        $meses = [
            1 => 'Ene',
            'Feb',
            'Mar',
            'Abr',
            'May',
            'Jun',
            'Jul',
            'Ago',
            'Sep',
            'Oct',
            'Nov',
            'Dic'
        ];

        // Obtener el día y el mes de la fecha
        $dia = $fecha->format('d');
        $mes = $meses[intval($fecha->format('m'))];

        // Imprimir el resultado en el formato deseado
        return $dia . '<br>' . $mes;
    }
}

if (!function_exists('dia_mes_ano')) {
    function dia_mes_ano($fechaOriginal) {
        // Crear un objeto DateTime a partir de la cadena de fecha
        $fecha = new DateTime($fechaOriginal);

        // Definir un arreglo de meses en español
        $meses = [
            1 => 'Ene',
            'Feb',
            'Mar',
            'Abr',
            'May',
            'Jun',
            'Jul',
            'Ago',
            'Sep',
            'Oct',
            'Nov',
            'Dic'
        ];

        // Obtener el día y el mes de la fecha
        $dia = $fecha->format('d');
        $mes = $meses[intval($fecha->format('m'))];
        $ano = $fecha->format('Y');

        // Imprimir el resultado en el formato deseado
        return $dia . ' ' . $mes  . ' ' . $ano;
    }
}


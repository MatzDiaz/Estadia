<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Reglas de Validación
    |--------------------------------------------------------------------------
    |
    | Aquí puedes definir los mensajes de error para cada una de las reglas de validación
    | que usas en tu aplicación. Si alguna de las reglas tiene un mensaje personalizado,
    | puedes sobrecargarlo aquí.
    |
    */

    // Validación genérica
    'accepted'             => 'Debe ser aceptado.',
    'active_url'           => 'No es una URL válida.',
    'after'                => 'Debe ser una fecha posterior a :date.',
    'after_or_equal'       => 'Debe ser una fecha posterior o igual a :date.',
    'alpha'                => 'Solo puede contener letras.',
    'alpha_dash'           => 'Solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num'            => 'Solo puede contener letras y números.',
    'array'                => 'Debe ser un arreglo.',
    'before'               => 'Debe ser una fecha anterior a :date.',
    'before_or_equal'      => 'Debe ser una fecha anterior o igual a :date.',
    'between'              => [
        'numeric' => 'Debe estar entre :min y :max.',
        'file'    => 'Debe pesar entre :min y :max kilobytes.',
        'string'  => 'Debe tener entre :min y :max caracteres.',
        'array'   => 'Debe tener entre :min y :max elementos.',
    ],
    'boolean'              => 'Debe ser verdadero o falso.',
    'confirmed'            => 'La confirmación no coincide.',
    'date'                 => 'No es una fecha válida.',
    'date_equals'          => 'Debe ser una fecha igual a :date.',
    'date_format'          => 'No coincide con el formato :format.',
    'different'            => 'Debe ser diferente de :other.',
    'digits'               => 'Debe ser un número de :digits dígitos.',
    'digits_between'       => 'Debe tener entre :min y :max dígitos.',
    'dimensions'           => 'La imagen tiene dimensiones no válidas.',
    'distinct'             => 'Este campo tiene un valor duplicado.',
    'email'                => 'Debe ser una dirección de correo electrónico válida.',
    'ends_with'            => 'Debe terminar con uno de los siguientes valores: :values.',
    'exists'               => 'El valor seleccionado no es válido.',
    'file'                 => 'Debe ser un archivo.',
    'filled'               => 'Este campo es obligatorio.',
    'gt'                   => [
        'numeric' => 'Debe ser mayor que :value.',
        'file'    => 'Debe pesar más que :value kilobytes.',
        'string'  => 'Debe tener más de :value caracteres.',
        'array'   => 'Debe tener más de :value elementos.',
    ],
    'gte'                  => [
        'numeric' => 'Debe ser mayor o igual que :value.',
        'file'    => 'Debe pesar más o igual que :value kilobytes.',
        'string'  => 'Debe tener :value caracteres o más.',
        'array'   => 'Debe tener :value elementos o más.',
    ],
    'image'                => 'Debe ser una imagen.',
    'in'                   => 'El valor seleccionado no es válido.',
    'in_array'             => 'Este valor no existe en :other.',
    'integer'              => 'Debe ser un número entero.',
    'ip'                   => 'Debe ser una dirección IP válida.',
    'ipv4'                 => 'Debe ser una dirección IPv4 válida.',
    'ipv6'                 => 'Debe ser una dirección IPv6 válida.',
    'json'                 => 'Debe ser una cadena JSON válida.',
    'lt'                   => [
        'numeric' => 'Debe ser menor que :value.',
        'file'    => 'Debe pesar menos que :value kilobytes.',
        'string'  => 'Debe tener menos de :value caracteres.',
        'array'   => 'Debe tener menos de :value elementos.',
    ],
    'lte'                  => [
        'numeric' => 'Debe ser menor o igual que :value.',
        'file'    => 'Debe pesar menos o igual que :value kilobytes.',
        'string'  => 'Debe tener :value caracteres o menos.',
        'array'   => 'Debe tener :value elementos o menos.',
    ],
    'max'                  => [
        'numeric' => 'No puede ser mayor que :max.',
        'file'    => 'No puede pesar más de :max kilobytes.',
        'string'  => 'No puede tener más de :max caracteres.',
        'array'   => 'No puede tener más de :max elementos.',
    ],
    'mimes'                => 'Debe ser un archivo de tipo: :values.',
    'mimetypes'            => 'Debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'Debe ser al menos :min.',
        'file'    => 'Debe pesar al menos :min kilobytes.',
        'string'  => 'Debe tener al menos :min caracteres.',
        'array'   => 'Debe tener al menos :min elementos.',
    ],
    'not_in'               => 'El valor seleccionado no es válido.',
    'not_regex'            => 'El formato no es válido.',
    'numeric'              => 'Debe ser un número.',
    'present'              => 'El campo debe estar presente.',
    'regex'                => 'El formato no es válido.',
    'required'             => 'Este campo es obligatorio.',
    'required_if'          => 'Este campo es obligatorio cuando :other es :value.',
    'required_unless'      => 'Este campo es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'Este campo es obligatorio cuando :values está presente.',
    'required_with_all'    => 'Este campo es obligatorio cuando :values están presentes.',
    'required_without'     => 'Este campo es obligatorio cuando :values no está presente.',
    'required_without_all' => 'Este campo es obligatorio cuando ninguno de los :values está presente.',
    'same'                 => 'Este campo y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'Debe ser :size.',
        'file'    => 'Debe pesar :size kilobytes.',
        'string'  => 'Debe tener :size caracteres.',
        'array'   => 'Debe contener :size elementos.',
    ],
    'starts_with'          => 'Debe comenzar con uno de los siguientes valores: :values.',
    'string'               => 'Debe ser una cadena de caracteres.',
    'timezone'             => 'Debe ser una zona horaria válida.',
    'unique'               => 'Ya ha sido tomado.',
    'uploaded'             => 'No se pudo cargar el archivo.',
    'url'                  => 'El formato no es válido.',
    'uuid'                 => 'Debe ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Mensajes Personalizados: Login y Registro
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'email' => 'Estas credenciales no coinciden con nuestros registros.',
        'password' => 'La contraseña proporcionada es incorrecta.',
        'throttle' => 'Demasiados intentos de acceso. Por favor, inténtelo de nuevo en :seconds segundos.',
    ],

    'register' => [
        'email_taken' => 'El correo electrónico ya está registrado.',
        'invalid_fields' => 'Algunos campos no son válidos, por favor corríjalos.',
    ],
];

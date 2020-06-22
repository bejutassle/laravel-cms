<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'error_title'   => 'Hata!',
    'accepted'   => ':attribute kabul edilmelidir.',
    'active_url' => ':attribute geçerli bir URL adresi olmalıdır.',
    'after'      => ':attribute, :date tarihinden daha eski bir tarih olmalıdır.',
    'alpha'      => ':attribute sadece harflerden oluşmalıdır.',
    'alpha_dash' => ':attribute sadece harfler, rakamlar ve tirelerden oluşmalıdır.',
    'alpha_num'  => ':attribute sadece harfler ve rakamlar içermelidir.',
    'array'      => ':attribute dizi olmalıdır.',
    'before'     => ':attribute, :date tarihinden daha önceki bir tarih olmalıdır.',
    'between'              => [
        'numeric' => ' :attribute, minimum :min, azami :max karakter olmalıdır.',
        'file'    => ':attribute :min - :max arasındaki kilobayt değeri olmalıdır.',
        'string'  => ':attribute :min - :max arasında karakterden oluşmalıdır.',
        'array'   => ':attribute :min - :max arasında nesneye sahip olmalıdır.',
    ],
    'boolean'        => ':attribute alanı sadece doğru veya yanlış olabilir.',
    'confirmed'            => ' :attribute kayıtlarımızla uğuşmamaktadır.',
    'date'                 => ' :attribute geçerli bir tarih değildir.',
    'date_format'    => ':attribute :format biçimi ile eşleşmiyor.',
    'different'      => ':attribute ile :other birbirinden farklı olmalıdır.',
    'digits'         => ':attribute :digits rakam olmalıdır.',
    'digits_between' => ':attribute :min ile :max arasında rakam olmalıdır.',
    'dimensions'     => ':attribute geçersiz resim ölçülerine sahiptir.',
    'distinct'       => ':attribute alanı tekrarlanan bir değere sahiptir.',
    'email'                => 'Geçerli bir mail adresi girmeniz gerekmektedir.',
    'exists'         => 'Seçili olan :attribute geçersiz.',
    'file'           => ':attribute dosya olmalıdır.',
    'filled'         => ':attribute alanının doldurulması zorunludur.',
    'image'                => 'Geçerli bir resim tipi seçiniz',
    'in'             => ':attribute değeri geçersiz.',
    'in_array'       => ':attribute değeri :other içinde mevcut değil.',
    'integer'        => ':attribute rakam olmalıdır.',
    'ip'             => ':attribute geçerli bir IP adresi olmalıdır.',
    'json'           => ':attribute geçerli bir JSON dizesi olmalıdır.',
    'max'                  => [
        'numeric' => ' :attribute, azami :max karakter olmalıdır.',
        'file'    => ' :attribute,  :max kilobaytdan büyük olamaz.',
        'string'  => ':attribute, azami :max karakter uzunluğunda olmalıdır.',
        'array'   => ':attribute, :max adedinden fazla nesneye sahip olmamalıdır.',
    ],
    'mimes'                => 'Lütfen geçerli bir dosya türü seçiniz.',
    'mimetypes'  => ':attribute dosya biçimi :values olmalıdır.',
    'min'                  => [
        'numeric' => ' :attribute, minumum :min karakter olmalıdır.',
        'file'    => ':attribute, en az :min kilobayt değerinde olmalıdır.',
        'string'  => ':attribute, en az :min karakter uzunluğunda olmalıdır.',
        'array'   => ':attribute, en az :min öğeye sahip olmalıdır.',
    ],
    'not_in'               => 'Seçili :attribute geçersiz.',
    'numeric'              => ' :attribute, bir sayı olmalıdır.',
    'present'              => ':attribute alanı var olmalıdır.',
    'regex'                => ':attribute biçimi geçersiz.',
    'required'             => ' :attribute alanı doldurulması zorunludur.',
    'required_if'          => ':attribute alanı, :other :value değerine sahip olduğunda zorunludur.',
    'required_unless'      => ':attribute alanı, :other :values değerine sahip olmadığında zorunludur.',
    'required_with'        => ':attribute alanı :values varken zorunludur.',
    'required_with_all'    => ':attribute alanı :values varken zorunludur.',
    'required_without'     => ':attribute alanı :values yokken zorunludur.',
    'required_without_all' => ':attribute alanı :values yokken zorunludur.',
    'same'                 => ':attribute ile :other aynı olmalıdır.',
    'size'                 => [
        'numeric' => ' :attribute, boyutları :size olmalıdır.',
        'file'    => ':attribute :size kilobayt olmalıdır.',
        'string'  => ':attribute :size karakter olmalıdır.',
        'array'   => ':attribute :size nesneye sahip olmalıdır.',
    ],
    'string'   => ':attribute karakterlerden oluşmalıdır.',
    'timezone' => ':attribute geçerli bir zaman bölgesi olmalıdır.',
    'unique'               => ' :attribute, zaten kullanılmaktadır.',
    'uploaded' => ':attribute yüklenirken hata oluştu.',
    'url'                  => ' :attribute geçerli bir adres değildir.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'type' => [
            'required' => 'Zorunlu alanları doldurunuz.',
        ],
        'color' => [
            'required' => 'Renk alanında bir seçim yapmalısınız.',
        ],
        'title' => [
            'required' => 'Başlık boş bırakılamaz.',
            'unique'  => 'Başlık daha önce kullanılmıştır.',
            'min' => 'Başlık minimum :min karakter olmalıdır.',
            'max' => 'Başlık azami :max karakter olmalıdır.',
        ],
        'slug' => [
            'required' => 'Sayfa Adresi boş bırakılamaz.',
            'unique'  => 'Sayfa Adresi daha önce kullanılmıştır.',
            'min' => 'Sayfa Adresi minimum :min karakter olmalıdır.',
            'max' => 'Sayfa Adresi azami :max karakter olmalıdır.',
        ],
        'text' => [
            'required' => 'İçerik boş bırakılamaz.',
            'unique'  => 'İçerik daha önce kullanılmıştır.',
            'min' => 'İçerik minimum :min karakter olmalıdır.',
            'max' => 'İçerik azami :max karakter olmalıdır.',
        ],
        'body' => 'İçerik alanı doldurulmalıdır',
        'category' => 'Lütfen bir kategori seçin',
        'description' => [
            'required' => 'Açıklama alanının doldurulması zorunludur',
            'min' => 'Açıklama alanı  minimum :min karakter olmalıdır.',
            'max' => 'Açıklama alanı  azami :max karakter olmalıdır.',
        ],
        'thumb' => [
            'required' => 'Önizleme resmi seçmediniz.',
        ],
        'username' => [
            'unique' => 'Bu kullanıcı adı alınmış',
            'min' => 'Kullanıcı adı minumum 6 karakter olmalıdır.',
            'max' => 'Kullanıcı adı azami 15 karakter olmalıdır.',
        ],
        'email' => [
            'required' => 'E-Posta adresi girmediniz',
            'email' => 'Geçerli bir E-Posta adresi girin',
            'max' => 'E-Posta adresi çok uzun',
            'unique' => 'Bu E-Posta adresine ait bir kullanıcı mevcut',
        ],
        'password' => [
            'required' => 'Şifrenizi girmediniz',
            'min' => 'Şifre alanı minimum 6 karakter olmalıdır',
            'max' => 'Şifre azami 15 karakter olmalıdır',
        ],
        'file' => [
            'required' => 'Herhangi bir Resim seçmediniz',
            'image' => 'Yüklemek için bir Resim seçin.',
            'mimes' => 'Resim formatı geçersiz.',
            'size' => 'Resim ebatları gereğinden yüksek.',
        ],
        'sitename' => [
            'required' => 'Site Adının doldurulması zorunludur',
            'min' => 'Site Adı  minimum :min karakter olmalıdır.',
            'max' => 'Site Adı  azami :max karakter olmalıdır.',
        ],
        'sitelanguage' => [
            'required' => 'Site Dil alanının doldurulması zorunludur',
            'min' => 'Site Dil alanı  minimum :min karakter olmalıdır.',
            'max' => 'Site Dil alanı  azami :max karakter olmalıdır.',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];

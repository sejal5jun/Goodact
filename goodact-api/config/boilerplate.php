<?php

return [

    'sign_up' => [
        'release_token' => env('SIGN_UP_RELEASE_TOKEN'),
        'validation_rules' => [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'access_token' => 'string|max:14'
        ],
        'validation_messages' => [
            'email.email'  => 'Please enter a valid email address',
        ]
    ],

    'login' => [
        'validation_rules' => [
            'email' => 'required|email',
            'password' => 'required'
        ],
        'validation_messages' => [
            'email.email'  => 'Please enter a valid email address',
        ]
    ],

    'email_verification' => [
        'validation_rules' => [
            'verification_token' => 'required',
        ],
        'validation_messages' => [
            'verification_token.required' => 'Verification Token was not provided in the URL.',
        ]
    ],

    'institute_users' => [
        'validation_rules' => [
            'user_excel' => [
                'required',
                'max:100000'
            ]
        ],

        'validation_messages' => [
            'user_excel.max'   => 'Max upload size is 100MB.',
            'user_excel.required'   => 'No file was uploaded'
        ]
    ],

    'faculty' => [
        'validation_rules' => [
            'faculty_excel' => [
                'required',            ]
        ],

        'validation_messages' => [
            'faculty_excel.required'   => 'No file was uploaded'
        ]
    ],

    'institute' => [
        'validation_rules' => [
            'institute_name' => ['required','string','max:50'],
            'fullname' => ["required","regex:/^[a-zA-Z\'\- ]*$/","max:50"],
            'address' => 'required|string|max:200',
            'city'  => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'category' => 'required|string|size:24',
            'students_count' => 'required|string',
            'streams' => 'required|string|size:24',
            'phone_number' => [
                        'required',
                        'regex:/((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}/'
            ],
            'password'  => 'required',
            'terms' => 'required'
        ],
        'validation_messages' => [
            'institute.required' => 'Please enter institute name',
            'streams.required' => 'Please enter the streams your Institute provides',
            'email.email'  => 'Please enter a valid email address',
            'fullname.regex' => 'Fullname is invalid',
            'terms.required' => 'Please accept the terms and conditions before you proceed.',
            'streams.size' => 'Invalid Stream ID',
            'category.size' => 'Invalid Category ID'
        ]
    ], 

    'edit_institute' => [
        'validation_rules' => [
            'institute_name' => ['required','string','max:80'],
            'address' => 'required|string|max:200',
            'city'  => 'required|string|max:150',
            'category' => 'required|string',
            'streams' => 'required|string|max:150',
            'courses'  => 'string',
            'about' => 'string|max:2000',
            'admissions' => 'string',
            'institute_logo' => 'string',
            'institute_banner' => 'string',
            'institute_email' => 'email',
            'institute_phone' => [
                        'regex:/((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}/'
                         ],
            'website_url' => 'url'
        ],
        'validation_messages' => [
            'about.max' => 'About should not be greater than 250 characters.',
            'admissions.max' => 'Admissions should not be greater than 250 characters.'
        ]
    ], 

    'create_classroom' => [
        'validation_rules' => [
            'classroom_name' => ['required','string','max:80'],
            'classroom_image' => 'string',
            'faculty' => 'nullable|string',
            'members_file' => 'nullable|file',
            'filter' => 'nullable|string'
        ],
        'validation_messages' => [

        ]
    ], 


    'forgot_password' => [
        'validation_rules' => [
            'email' => 'required|email'
        ]
    ],

    'reset_password' => [
        'release_token' => env('PASSWORD_RESET_RELEASE_TOKEN', false),
        'validation_rules' => [
            'reset_token' => 'required',
            'password' => 'required|confirmed'
        ]
    ],

    'add_activity' => [
        'validation_rules' => [
            'title' => ['required','string','max:200'],
            'description' => ['required','string','max:200'],
            'age_group' => ['string'],
            'address' => ['required','string','max:200'],
            'type' => ['string'],
            'contact' => ['string','max:300'],
            'internal' => ['int'],
            'searchable' => ['int'],
            'date' => ['string'],
            'who_attend' => ['int'],
        ],

        'validation_messages' => [
           'title.required' => 'Please enter activity title',
           'description.required' => 'Please enter description'

        ],
    ],

    'change_password' => [
        'validation_rules' => [
            'password' => 'required|confirmed',
            'current_password' => 'required'
        ]
    ],

];

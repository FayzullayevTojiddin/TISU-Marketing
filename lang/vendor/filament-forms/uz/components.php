<?php

return [
    'select' => [
        'actions' => [
            'create_option' => [
                'modal' => [
                    'heading' => 'Yangi yaratish',
                    'actions' => [
                        'create' => [
                            'label' => 'Yaratish',
                        ],
                        'create_another' => [
                            'label' => 'Yana yaratish',
                        ],
                    ],
                ],
            ],
            'edit_option' => [
                'modal' => [
                    'heading' => 'Tahrirlash',
                    'actions' => [
                        'save' => [
                            'label' => 'Saqlash',
                        ],
                    ],
                ],
            ],
        ],
        'boolean' => [
            'true' => 'Ha',
            'false' => 'Yo\'q',
        ],
        'loading_message' => 'Yuklanmoqda...',
        'max_items_message' => 'Faqat :count ta tanlash mumkin.',
        'no_search_results_message' => 'Qidiruv natijalari topilmadi.',
        'placeholder' => 'Tanlang',
        'searching_message' => 'Qidirilmoqda...',
        'search_prompt' => 'Qidirish uchun yozing...',
    ],
];

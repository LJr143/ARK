<?php

// config/receipt.php
// Add this configuration file to your Laravel config directory

return [
    /*
    |--------------------------------------------------------------------------
    | Company Information
    |--------------------------------------------------------------------------
    |
    | This configuration is used to display company information on receipts.
    | You can modify these values according to your organization.
    |
    */
    'company_name' => env('RECEIPT_COMPANY_NAME', config('app.name')),
    'company_address' => env('RECEIPT_COMPANY_ADDRESS', '123 Main Street, City, State, ZIP'),
    'company_phone' => env('RECEIPT_COMPANY_PHONE', '+1 (555) 123-4567'),
    'company_email' => env('RECEIPT_COMPANY_EMAIL', 'info@company.com'),
    'company_website' => env('RECEIPT_COMPANY_WEBSITE', config('app.url')),
    'company_logo' => env('RECEIPT_COMPANY_LOGO', null), // Path to logo file

    /*
    |--------------------------------------------------------------------------
    | Receipt Settings
    |--------------------------------------------------------------------------
    |
    | Configure receipt generation settings
    |
    */
    'default_currency' => env('RECEIPT_DEFAULT_CURRENCY', 'PHP'),
    'date_format' => env('RECEIPT_DATE_FORMAT', 'M d, Y h:i A'),
    'number_format' => [
        'decimals' => 2,
        'decimal_separator' => '.',
        'thousands_separator' => ',',
    ],

    /*
    |--------------------------------------------------------------------------
    | PDF Settings
    |--------------------------------------------------------------------------
    |
    | Configure PDF generation settings
    |
    */
    'pdf' => [
        'paper_size' => env('RECEIPT_PDF_PAPER_SIZE', 'A4'),
        'orientation' => env('RECEIPT_PDF_ORIENTATION', 'portrait'),
        'dpi' => env('RECEIPT_PDF_DPI', 150),
        'font_family' => env('RECEIPT_PDF_FONT', 'Arial'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Storage Settings
    |--------------------------------------------------------------------------
    |
    | Configure where receipts are stored
    |
    */
    'storage' => [
        'disk' => env('RECEIPT_STORAGE_DISK', 'public'),
        'path' => env('RECEIPT_STORAGE_PATH', 'receipts'),
        'keep_generated_files' => env('RECEIPT_KEEP_FILES', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Settings
    |--------------------------------------------------------------------------
    |
    | Configure receipt email settings
    |
    */
    'email' => [
        'from_address' => env('RECEIPT_EMAIL_FROM', config('mail.from.address')),
        'from_name' => env('RECEIPT_EMAIL_FROM_NAME', config('mail.from.name')),
        'subject' => env('RECEIPT_EMAIL_SUBJECT', 'Your Payment Receipt - :receipt_number'),
        'template' => env('RECEIPT_EMAIL_TEMPLATE', 'emails.receipt'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Configure receipt security settings
    |
    */
    'security' => [
        'enable_public_access' => env('RECEIPT_PUBLIC_ACCESS', false),
        'public_token_expiry' => env('RECEIPT_PUBLIC_TOKEN_EXPIRY', 7), // days
        'rate_limit' => env('RECEIPT_RATE_LIMIT', 60), // requests per minute
    ],

    /*
    |--------------------------------------------------------------------------
    | Watermark Settings
    |--------------------------------------------------------------------------
    |
    | Configure receipt watermark (optional)
    |
    */
    'watermark' => [
        'enabled' => env('RECEIPT_WATERMARK_ENABLED', false),
        'text' => env('RECEIPT_WATERMARK_TEXT', 'OFFICIAL RECEIPT'),
        'opacity' => env('RECEIPT_WATERMARK_OPACITY', 0.1),
        'image' => env('RECEIPT_WATERMARK_IMAGE', null), // Path to watermark image
    ],

    /*
    |--------------------------------------------------------------------------
    | Template Settings
    |--------------------------------------------------------------------------
    |
    | Configure receipt template settings
    |
    */
    'templates' => [
        'pdf' => 'receipts.payment-receipt',
        'html' => 'receipts.payment-receipt-html',
        'email' => 'receipts.payment-receipt-email',
    ],

    /*
    |--------------------------------------------------------------------------
    | Feature Flags
    |--------------------------------------------------------------------------
    |
    | Enable or disable specific receipt features
    |
    */
    'features' => [
        'bulk_download' => env('RECEIPT_BULK_DOWNLOAD', true),
        'email_receipt' => env('RECEIPT_EMAIL_ENABLED', true),
        'qr_code' => env('RECEIPT_QR_CODE', false),
        'digital_signature' => env('RECEIPT_DIGITAL_SIGNATURE', false),
        'tax_breakdown' => env('RECEIPT_TAX_BREAKDOWN', false),
    ],
];

<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Upload file.
 *
 * Maps to the official Checkout.com endpoint POST /files.
 */
class CheckoutComUploadFile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_upload_file';
    protected const DESCRIPTION = 'Upload a file to use as evidence in a dispute. Your file must be in either JPEG/JPG, PNG or PDF format, and be no larger than 4MB.

Official Checkout.com endpoint: POST /files.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/files';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'multipart/form-data';
    protected const REQUIRES_AUTH = true;
}

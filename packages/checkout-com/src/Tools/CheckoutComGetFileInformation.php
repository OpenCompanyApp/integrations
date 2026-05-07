<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get file information.
 *
 * Maps to the official Checkout.com endpoint GET /files/{file_id}.
 */
class CheckoutComGetFileInformation extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_file_information';
    protected const DESCRIPTION = 'Retrieve information about a file that was previously uploaded.

Official Checkout.com endpoint: GET /files/{file_id}.';
    protected const PARAMETERS = [
        'file_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The file identifier. It is always prefixed by `file_`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/files/{file_id}';
    protected const PATH_PARAMS = [
        'file_id' => 'file_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

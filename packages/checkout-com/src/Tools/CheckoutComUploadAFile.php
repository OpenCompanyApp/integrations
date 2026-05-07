<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Upload a file.
 *
 * Maps to the official Checkout.com endpoint POST /entities/{entityId}/files.
 */
class CheckoutComUploadAFile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_upload_a_file';
    protected const DESCRIPTION = 'Upload a file

Official Checkout.com endpoint: POST /entities/{entityId}/files.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the sub-entity',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/entities/{entityId}/files';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Retrieve a file.
 *
 * Maps to the official Checkout.com endpoint GET /entities/{entityId}/files/{fileId}.
 */
class CheckoutComRetrieveAFile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_retrieve_a_file';
    protected const DESCRIPTION = 'Retrieve information about a previously uploaded file. Please note that the sub-domain – https://files.checkout.com – is slightly different to Checkout.com\'s other endpoints. See the documentation for more information.

Official Checkout.com endpoint: GET /entities/{entityId}/files/{fileId}.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the sub-entity',
        ],
        'file_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the file. The value is always prefixed with `file_`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/entities/{entityId}/files/{fileId}';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
        'fileId' => 'file_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

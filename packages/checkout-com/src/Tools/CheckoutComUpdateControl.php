<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a control.
 *
 * Maps to the official Checkout.com endpoint PUT /issuing/controls/{controlId}.
 */
class CheckoutComUpdateControl extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_control';
    protected const DESCRIPTION = 'Updates an existing control.

Official Checkout.com endpoint: PUT /issuing/controls/{controlId}.';
    protected const PARAMETERS = [
        'control_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlId',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/issuing/controls/{controlId}';
    protected const PATH_PARAMS = [
        'controlId' => 'control_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

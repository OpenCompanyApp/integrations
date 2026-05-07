<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get controls by target.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/controls.
 */
class CheckoutComGetControlByTarget extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_control_by_target';
    protected const DESCRIPTION = 'Retrieves a list of spending controls applied to the specified target.

Official Checkout.com endpoint: GET /issuing/controls.';
    protected const PARAMETERS = [
        'target_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'target_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/controls';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'target_id' => 'target_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

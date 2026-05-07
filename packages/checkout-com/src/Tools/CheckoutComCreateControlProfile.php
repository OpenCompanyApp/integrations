<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a control profile.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/controls/control-profiles.
 */
class CheckoutComCreateControlProfile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_control_profile';
    protected const DESCRIPTION = 'Creates a control profile.

Official Checkout.com endpoint: POST /issuing/controls/control-profiles.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/controls/control-profiles';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create a control group.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/controls/control-groups.
 */
class CheckoutComCreateControlGroup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_control_group';
    protected const DESCRIPTION = 'Creates a control group and applies it to the specified target.

Official Checkout.com endpoint: POST /issuing/controls/control-groups.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/controls/control-groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

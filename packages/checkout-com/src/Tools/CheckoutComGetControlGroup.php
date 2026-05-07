<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get control group details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/controls/control-groups/{controlGroupId}.
 */
class CheckoutComGetControlGroup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_control_group';
    protected const DESCRIPTION = 'Retrieves the details of a control group you created previously.

Official Checkout.com endpoint: GET /issuing/controls/control-groups/{controlGroupId}.';
    protected const PARAMETERS = [
        'control_group_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlGroupId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/controls/control-groups/{controlGroupId}';
    protected const PATH_PARAMS = [
        'controlGroupId' => 'control_group_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

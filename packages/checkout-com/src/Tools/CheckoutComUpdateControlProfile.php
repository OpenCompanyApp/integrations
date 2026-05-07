<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a control profile.
 *
 * Maps to the official Checkout.com endpoint PATCH /issuing/controls/control-profiles/{controlProfileId}.
 */
class CheckoutComUpdateControlProfile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_control_profile';
    protected const DESCRIPTION = 'Update the control profile

Official Checkout.com endpoint: PATCH /issuing/controls/control-profiles/{controlProfileId}.';
    protected const PARAMETERS = [
        'control_profile_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlProfileId',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/issuing/controls/control-profiles/{controlProfileId}';
    protected const PATH_PARAMS = [
        'controlProfileId' => 'control_profile_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

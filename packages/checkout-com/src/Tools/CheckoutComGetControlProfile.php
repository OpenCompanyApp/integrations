<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get control profile details.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/controls/control-profiles/{controlProfileId}.
 */
class CheckoutComGetControlProfile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_control_profile';
    protected const DESCRIPTION = 'Retrieves the details of an existing control profile.

Official Checkout.com endpoint: GET /issuing/controls/control-profiles/{controlProfileId}.';
    protected const PARAMETERS = [
        'control_profile_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlProfileId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/controls/control-profiles/{controlProfileId}';
    protected const PATH_PARAMS = [
        'controlProfileId' => 'control_profile_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

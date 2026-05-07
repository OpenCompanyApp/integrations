<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get all control profiles.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/controls/control-profiles.
 */
class CheckoutComGetControlProfilesByTarget extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_control_profiles_by_target';
    protected const DESCRIPTION = 'Retrieves a list of control profiles for the currently authenticated client, or for a specific card if a card ID is provided.

Official Checkout.com endpoint: GET /issuing/controls/control-profiles.';
    protected const PARAMETERS = [
        'target_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'target_id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/controls/control-profiles';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'target_id' => 'target_id',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

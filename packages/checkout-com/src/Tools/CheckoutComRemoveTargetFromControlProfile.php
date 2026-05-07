<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove target from control profile.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/controls/control-profiles/{controlProfileId}/remove/{targetId}.
 */
class CheckoutComRemoveTargetFromControlProfile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_remove_target_from_control_profile';
    protected const DESCRIPTION = 'Removes a target from an existing control profile.

Official Checkout.com endpoint: POST /issuing/controls/control-profiles/{controlProfileId}/remove/{targetId}.';
    protected const PARAMETERS = [
        'control_profile_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlProfileId',
        ],
        'target_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'targetId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/controls/control-profiles/{controlProfileId}/remove/{targetId}';
    protected const PATH_PARAMS = [
        'controlProfileId' => 'control_profile_id',
        'targetId' => 'target_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

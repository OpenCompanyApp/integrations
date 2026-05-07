<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove a control profile.
 *
 * Maps to the official Checkout.com endpoint DELETE /issuing/controls/control-profiles/{controlProfileId}.
 */
class CheckoutComDeleteControlProfile extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_control_profile';
    protected const DESCRIPTION = 'Removes the control profile. A control profile cannot be removed if it is used by a control.

Official Checkout.com endpoint: DELETE /issuing/controls/control-profiles/{controlProfileId}.';
    protected const PARAMETERS = [
        'control_profile_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlProfileId',
        ],
    ];
    protected const METHOD = 'DELETE';
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

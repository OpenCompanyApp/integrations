<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove a control group.
 *
 * Maps to the official Checkout.com endpoint DELETE /issuing/controls/control-groups/{controlGroupId}.
 */
class CheckoutComDeleteControlGroup extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_control_group';
    protected const DESCRIPTION = 'Removes the control group and all the controls it contains. If you want to reapply an equivalent control group to the card, you\'ll need to create a new control group.

Official Checkout.com endpoint: DELETE /issuing/controls/control-groups/{controlGroupId}.';
    protected const PARAMETERS = [
        'control_group_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlGroupId',
        ],
    ];
    protected const METHOD = 'DELETE';
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

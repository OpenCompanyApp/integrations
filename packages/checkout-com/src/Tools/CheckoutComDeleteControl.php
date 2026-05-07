<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Remove a control.
 *
 * Maps to the official Checkout.com endpoint DELETE /issuing/controls/{controlId}.
 */
class CheckoutComDeleteControl extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_delete_control';
    protected const DESCRIPTION = 'Removes an existing control from the target it was applied to. If you want to reapply an equivalent control to the target, you must create a new control.

Official Checkout.com endpoint: DELETE /issuing/controls/{controlId}.';
    protected const PARAMETERS = [
        'control_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'controlId',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/issuing/controls/{controlId}';
    protected const PATH_PARAMS = [
        'controlId' => 'control_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

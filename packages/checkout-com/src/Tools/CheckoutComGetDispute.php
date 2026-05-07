<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get an Issuing dispute.
 *
 * Maps to the official Checkout.com endpoint GET /issuing/disputes/{disputeId}.
 */
class CheckoutComGetDispute extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_dispute';
    protected const DESCRIPTION = 'Beta Retrieve the details of an [Issuing dispute](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes).

Official Checkout.com endpoint: GET /issuing/disputes/{disputeId}.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'disputeId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/issuing/disputes/{disputeId}';
    protected const PATH_PARAMS = [
        'disputeId' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

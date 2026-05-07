<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Escalate an Issuing dispute.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/disputes/{disputeId}/escalate.
 */
class CheckoutComEscalateDispute extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_escalate_dispute';
    protected const DESCRIPTION = 'Beta Escalate an [Issuing dispute](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes) to pre-arbitration or arbitration.

Official Checkout.com endpoint: POST /issuing/disputes/{disputeId}/escalate.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'An idempotency key for safely retrying requests.',
        ],
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'disputeId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/disputes/{disputeId}/escalate';
    protected const PATH_PARAMS = [
        'disputeId' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

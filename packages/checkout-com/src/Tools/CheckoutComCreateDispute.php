<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Create an Issuing dispute.
 *
 * Maps to the official Checkout.com endpoint POST /issuing/disputes.
 */
class CheckoutComCreateDispute extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_create_dispute';
    protected const DESCRIPTION = 'Beta Create a dispute for an Issuing transaction. For full guidance, see [Manage Issuing disputes](https://www.checkout.com/docs/card-issuing/manage-cardholder-transactions/manage-issuing-disputes). The transaction must already be cleared and not refunded. For the card scheme to process the chargeback, you must submit the dispute using this endpoint.

Official Checkout.com endpoint: POST /issuing/disputes.';
    protected const PARAMETERS = [
        'cko_idempotency_key' => [
            'type' => 'string',
            'required' => true,
            'description' => 'An idempotency key for safely retrying requests.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/issuing/disputes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Cko-Idempotency-Key' => 'cko_idempotency_key',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

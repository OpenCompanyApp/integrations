<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update payment instrument details.
 *
 * Maps to the official Checkout.com endpoint PATCH /accounts/entities/{entityId}/payment-instruments/{id}.
 */
class CheckoutComUpdatePlatformsPaymentInstrument extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_platforms_payment_instrument';
    protected const DESCRIPTION = 'Set an existing payment instrument as default. This will make it the destination instrument when a scheduled payout is made. You can also update the label of a payment instrument.

Official Checkout.com endpoint: PATCH /accounts/entities/{entityId}/payment-instruments/{id}.';
    protected const PARAMETERS = [
        'entity_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The sub-entity\'s ID.',
        ],
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payment instrument\'s ID.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/accounts/entities/{entityId}/payment-instruments/{id}';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get payment instrument details.
 *
 * Maps to the official Checkout.com endpoint GET /accounts/entities/{entityId}/payment-instruments/{id}.
 */
class CheckoutComGetPlatformsPaymentInstrument extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_platforms_payment_instrument';
    protected const DESCRIPTION = 'Retrieve the details of a specific payment instrument used for sub-entity payouts.

Official Checkout.com endpoint: GET /accounts/entities/{entityId}/payment-instruments/{id}.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/accounts/entities/{entityId}/payment-instruments/{id}';
    protected const PATH_PARAMS = [
        'entityId' => 'entity_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}

<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Intents > Confirm a PaymentIntent - payment_method = card.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/pa/payment_intents/{payment_intent_id}/confirm.
 */
class AirwallexOnlinePaymentsConfirmAPaymentintentPaymentMethodCard extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_confirm_a_paymentintent_payment_method_card';
    protected const DESCRIPTION = 'Online Payments > Payment Intents > Confirm a PaymentIntent - payment_method = card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_intents/{payment_intent_id}/confirm.';
    protected const PARAMETERS = [
        'payment_intent_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_intent_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/pa/payment_intents/{payment_intent_id}/confirm';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_intent_id' => 'payment_intent_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

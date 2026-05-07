<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Intents > Retrieve a PaymentIntent.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/payment_intents/{payment_intent_id}.
 */
class AirwallexOnlinePaymentsRetrieveAPaymentintent extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_a_paymentintent';
    protected const DESCRIPTION = 'Online Payments > Payment Intents > Retrieve a PaymentIntent.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_intents/{payment_intent_id}.';
    protected const PARAMETERS = [
        'payment_intent_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_intent_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/payment_intents/{payment_intent_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_intent_id' => 'payment_intent_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

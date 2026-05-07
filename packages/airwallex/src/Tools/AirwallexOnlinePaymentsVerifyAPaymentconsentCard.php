<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Consents > Verify a PaymentConsent - Card.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/pa/payment_consents/{id}/verify.
 */
class AirwallexOnlinePaymentsVerifyAPaymentconsentCard extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_verify_a_paymentconsent_card';
    protected const DESCRIPTION = 'Online Payments > Payment Consents > Verify a PaymentConsent - Card.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_consents/{id}/verify.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/pa/payment_consents/{id}/verify';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

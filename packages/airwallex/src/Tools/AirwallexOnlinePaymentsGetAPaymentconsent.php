<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Consents > Get a PaymentConsent.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/payment_consents/{payment_consent_id}.
 */
class AirwallexOnlinePaymentsGetAPaymentconsent extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_get_a_paymentconsent';
    protected const DESCRIPTION = 'Online Payments > Payment Consents > Get a PaymentConsent.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_consents/{payment_consent_id}.';
    protected const PARAMETERS = [
        'payment_consent_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_consent_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/payment_consents/{payment_consent_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_consent_id' => 'payment_consent_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

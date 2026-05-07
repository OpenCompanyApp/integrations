<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Methods > Create a PaymentMethod.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/pa/payment_methods/create.
 */
class AirwallexOnlinePaymentsCreateAPaymentmethod extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_create_a_paymentmethod';
    protected const DESCRIPTION = 'Online Payments > Payment Methods > Create a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_methods/create.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/pa/payment_methods/create';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Config > Retrieve available payment method types.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/config/payment_method_types.
 */
class AirwallexOnlinePaymentsRetrieveAvailablePaymentMethodTypes extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_available_payment_method_types';
    protected const DESCRIPTION = 'Online Payments > Config > Retrieve available payment method types.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/config/payment_method_types.';
    protected const PARAMETERS = [
        'active' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Indicate whether the payment method type is active',
        ],
        'country_code' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The supported country code.',
        ],
        'transaction_currency' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The supported transaction currency. transaction_currency is required when country_code is given.',
        ],
        'transaction_mode' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The supported transaction mode. One of oneoff, recurring.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/config/payment_method_types';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'active' => 'active',
        'country_code' => 'country_code',
        'transaction_currency' => 'transaction_currency',
        'transaction_mode' => 'transaction_mode',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

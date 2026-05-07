<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Config > Retrieve bank names for certain payment method types.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/config/banks.
 */
class AirwallexOnlinePaymentsRetrieveBankNamesForCertainPaymentMethodTypes extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_bank_names_for_certain_payment_method_types';
    protected const DESCRIPTION = 'Online Payments > Config > Retrieve bank names for certain payment method types.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/config/banks.';
    protected const PARAMETERS = [
        'payment_method_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The payment method type to find the available banks. One of fpx, bank_transfer, online_banking. For other payment methods that does not require bank_name, an empty list will be returned.',
        ],
        'country_code' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Country code to filter the available banks. Use the two-character ISO Standard Country Codes.

For payment method type like online_banking and bank_transfer, the available bank list differs in different countries and country_code is needed to get the bank list.

For other payment method types, country_code will be ignored.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/config/banks';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'payment_method_type' => 'payment_method_type',
        'country_code' => 'country_code',
    ];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

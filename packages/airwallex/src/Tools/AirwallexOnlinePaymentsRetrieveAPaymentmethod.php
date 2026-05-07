<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Methods > Retrieve a PaymentMethod.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/payment_methods/{payment_method_id}.
 */
class AirwallexOnlinePaymentsRetrieveAPaymentmethod extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_a_paymentmethod';
    protected const DESCRIPTION = 'Online Payments > Payment Methods > Retrieve a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_methods/{payment_method_id}.';
    protected const PARAMETERS = [
        'payment_method_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_method_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/payment_methods/{payment_method_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_method_id' => 'payment_method_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

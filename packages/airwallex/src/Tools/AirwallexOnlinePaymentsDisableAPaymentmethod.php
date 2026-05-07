<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Methods > Disable a PaymentMethod.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/pa/payment_methods/{payment_method_id}/disable.
 */
class AirwallexOnlinePaymentsDisableAPaymentmethod extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_disable_a_paymentmethod';
    protected const DESCRIPTION = 'Online Payments > Payment Methods > Disable a PaymentMethod.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/pa/payment_methods/{payment_method_id}/disable.';
    protected const PARAMETERS = [
        'payment_method_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_method_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/pa/payment_methods/{payment_method_id}/disable';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_method_id' => 'payment_method_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

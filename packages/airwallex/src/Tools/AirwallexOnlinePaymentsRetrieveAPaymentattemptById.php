<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Payment Attempts > Retrieve a PaymentAttempt by ID.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/payment_attempts/{payment_attempt_id}.
 */
class AirwallexOnlinePaymentsRetrieveAPaymentattemptById extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_a_paymentattempt_by_id';
    protected const DESCRIPTION = 'Online Payments > Payment Attempts > Retrieve a PaymentAttempt by ID.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/payment_attempts/{payment_attempt_id}.';
    protected const PARAMETERS = [
        'payment_attempt_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_attempt_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/payment_attempts/{payment_attempt_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_attempt_id' => 'payment_attempt_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Billing > Payment Sources > Get a Payment Source.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/payment_sources/{payment_source_id}.
 */
class AirwallexBillingGetAPaymentSource extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_billing_get_a_payment_source';
    protected const DESCRIPTION = 'Billing > Payment Sources > Get a Payment Source.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/payment_sources/{payment_source_id}.';
    protected const PARAMETERS = [
        'payment_source_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `payment_source_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/payment_sources/{payment_source_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'payment_source_id' => 'payment_source_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

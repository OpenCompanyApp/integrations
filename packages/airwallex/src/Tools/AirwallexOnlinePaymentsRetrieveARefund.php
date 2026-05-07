<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Online Payments > Refunds > Retrieve a Refund.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/pa/refunds/{refund_id}.
 */
class AirwallexOnlinePaymentsRetrieveARefund extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_online_payments_retrieve_a_refund';
    protected const DESCRIPTION = 'Online Payments > Refunds > Retrieve a Refund.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/pa/refunds/{refund_id}.';
    protected const PARAMETERS = [
        'refund_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `refund_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pa/refunds/{refund_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'refund_id' => 'refund_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

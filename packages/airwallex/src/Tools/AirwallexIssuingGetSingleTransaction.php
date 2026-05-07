<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Issuing > Transactions > Get single transaction.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/issuing/transactions/{issuing_transaction_id}.
 */
class AirwallexIssuingGetSingleTransaction extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_issuing_get_single_transaction';
    protected const DESCRIPTION = 'Issuing > Transactions > Get single transaction.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/issuing/transactions/{issuing_transaction_id}.';
    protected const PARAMETERS = [
        'issuing_transaction_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `issuing_transaction_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/issuing/transactions/{issuing_transaction_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'issuing_transaction_id' => 'issuing_transaction_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

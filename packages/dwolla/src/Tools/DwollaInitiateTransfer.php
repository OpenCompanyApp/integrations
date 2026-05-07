<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Initiate a transfer.
 *
 * Maps to the official Dwolla endpoint POST /transfers.
 */
class DwollaInitiateTransfer extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_initiate_transfer';
    protected const DESCRIPTION = 'Initiate a transfer

Official Dwolla endpoint: POST /transfers.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Idempotency-Key',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/transfers';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
        'Idempotency-Key' => 'idempotency_key',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

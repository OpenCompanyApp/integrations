<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Perform a bank details lookup.
 *
 * Maps to the official GoCardless endpoint POST /bank_details_lookups.
 */
class GoCardlessCreateBankDetailsLookup extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_bank_details_lookup';
    protected const DESCRIPTION = 'Perform a bank details lookup

Official GoCardless endpoint: POST /bank_details_lookups.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/bank_details_lookups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

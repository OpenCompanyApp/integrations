<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a Bank Authorisation.
 *
 * Maps to the official GoCardless endpoint POST /bank_authorisations.
 */
class GoCardlessCreateBankAuthorisation extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_bank_authorisation';
    protected const DESCRIPTION = 'Create a Bank Authorisation.

Official GoCardless endpoint: POST /bank_authorisations.';
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
    protected const PATH = '/bank_authorisations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

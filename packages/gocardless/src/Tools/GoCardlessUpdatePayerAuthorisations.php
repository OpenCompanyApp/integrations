<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a Payer Authorisation.
 *
 * Maps to the official GoCardless endpoint PUT /payer_authorisations/{payer_authorisation_id}.
 */
class GoCardlessUpdatePayerAuthorisations extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_payer_authorisations';
    protected const DESCRIPTION = 'Update a Payer Authorisation

Official GoCardless endpoint: PUT /payer_authorisations/{payer_authorisation_id}.';
    protected const PARAMETERS = [
        'payer_authorisation_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The payer authorisation id',
        ],
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
    protected const METHOD = 'PUT';
    protected const PATH = '/payer_authorisations/{payer_authorisation_id}';
    protected const PATH_PARAMS = [
        'payer_authorisation_id' => 'payer_authorisation_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a verification detail.
 *
 * Maps to the official GoCardless endpoint POST /verification_details.
 */
class GoCardlessCreateVerificationDetail extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_verification_detail';
    protected const DESCRIPTION = 'Creates a new verification detail

Official GoCardless endpoint: POST /verification_details.';
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
    protected const PATH = '/verification_details';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

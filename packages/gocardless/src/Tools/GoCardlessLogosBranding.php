<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a logo associated with a creditor.
 *
 * Maps to the official GoCardless endpoint POST /branding/logos.
 */
class GoCardlessLogosBranding extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_logos_branding';
    protected const DESCRIPTION = 'Create a logo associated with a creditor

Official GoCardless endpoint: POST /branding/logos.';
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
    protected const PATH = '/branding/logos';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

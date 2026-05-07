<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a payer theme associated with a creditor.
 *
 * Maps to the official GoCardless endpoint POST /branding/payer_themes.
 */
class GoCardlessPayerThemesBranding extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_payer_themes_branding';
    protected const DESCRIPTION = 'Creates a new payer theme associated with a creditor. If a creditor already has payer themes, this will update the existing payer theme linked to the creditor.

Official GoCardless endpoint: POST /branding/payer_themes.';
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
    protected const PATH = '/branding/payer_themes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create (with schedule).
 *
 * Maps to the official GoCardless endpoint POST /instalment_schedules.
 */
class GoCardlessCreateInstalmentSchedule extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_instalment_schedule';
    protected const DESCRIPTION = 'Create (with schedule)

Official GoCardless endpoint: POST /instalment_schedules.';
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
    protected const PATH = '/instalment_schedules';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

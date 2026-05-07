<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update an instalment schedule.
 *
 * Maps to the official GoCardless endpoint PUT /instalment_schedules/{instalment_schedule_id}.
 */
class GoCardlessUpdateInstalmentSchedules extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_instalment_schedules';
    protected const DESCRIPTION = 'Updates an instalment schedule. This accepts only the metadata parameter.

Official GoCardless endpoint: PUT /instalment_schedules/{instalment_schedule_id}.';
    protected const PARAMETERS = [
        'instalment_schedule_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The instalment schedule id',
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
    protected const PATH = '/instalment_schedules/{instalment_schedule_id}';
    protected const PATH_PARAMS = [
        'instalment_schedule_id' => 'instalment_schedule_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

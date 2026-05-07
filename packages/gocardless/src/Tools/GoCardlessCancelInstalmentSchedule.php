<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Cancel an instalment schedule.
 *
 * Maps to the official GoCardless endpoint POST /instalment_schedules/{instalment_schedule_id}/actions/cancel.
 */
class GoCardlessCancelInstalmentSchedule extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_cancel_instalment_schedule';
    protected const DESCRIPTION = 'Immediately cancels an instalment schedule; no further payments will be collected for it. This will fail with a `cancellation_failed` error if the instalment schedule is already cancelled or has completed.

Official GoCardless endpoint: POST /instalment_schedules/{instalment_schedule_id}/actions/cancel.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/instalment_schedules/{instalment_schedule_id}/actions/cancel';
    protected const PATH_PARAMS = [
        'instalment_schedule_id' => 'instalment_schedule_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

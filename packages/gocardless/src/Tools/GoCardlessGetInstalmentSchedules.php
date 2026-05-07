<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single instalment schedule.
 *
 * Maps to the official GoCardless endpoint GET /instalment_schedules/{instalment_schedule_id}.
 */
class GoCardlessGetInstalmentSchedules extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_instalment_schedules';
    protected const DESCRIPTION = 'Retrieves the details of an existing instalment schedule.

Official GoCardless endpoint: GET /instalment_schedules/{instalment_schedule_id}.';
    protected const PARAMETERS = [
        'instalment_schedule_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The instalment schedule id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/instalment_schedules/{instalment_schedule_id}';
    protected const PATH_PARAMS = [
        'instalment_schedule_id' => 'instalment_schedule_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

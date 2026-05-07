<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a schedule.
 *
 * Maps to the official Rootly endpoint delete /v1/schedules/{id}.
 */
class RootlyDeleteSchedule extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_schedule';
    protected const DESCRIPTION = 'Delete a schedule

Official Rootly endpoint: DELETE /v1/schedules/{id}

Delete a specific schedule by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/schedules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

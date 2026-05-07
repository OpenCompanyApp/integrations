<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a schedule rotation active day.
 *
 * Maps to the official Rootly endpoint delete /v1/schedule_rotation_active_days/{id}.
 */
class RootlyDeleteScheduleRotationActiveDay extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_schedule_rotation_active_day';
    protected const DESCRIPTION = 'Delete a schedule rotation active day

Official Rootly endpoint: DELETE /v1/schedule_rotation_active_days/{id}

Delete a specific schedule rotation active day';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/schedule_rotation_active_days/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

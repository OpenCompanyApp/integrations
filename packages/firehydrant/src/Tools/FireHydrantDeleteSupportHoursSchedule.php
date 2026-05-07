<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a specific support hours schedule.
 *
 * Maps to the official FireHydrant endpoint delete /v1/teams/{team_id}/support_hours_schedule.
 */
class FireHydrantDeleteSupportHoursSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_support_hours_schedule';
    protected const DESCRIPTION = 'Delete a specific support hours schedule

Official FireHydrant endpoint: DELETE /v1/teams/{team_id}/support_hours_schedule

Delete a specific support hours schedule';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/teams/{team_id}/support_hours_schedule';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

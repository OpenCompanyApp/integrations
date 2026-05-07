<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get support hours schedule.
 *
 * Maps to the official FireHydrant endpoint get /v1/teams/{team_id}/support_hours_schedule.
 */
class FireHydrantGetSupportHoursSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_support_hours_schedule';
    protected const DESCRIPTION = 'Get support hours schedule

Official FireHydrant endpoint: GET /v1/teams/{team_id}/support_hours_schedule

Get support hours schedule for the team';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

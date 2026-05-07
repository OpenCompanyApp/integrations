<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update support hours schedule.
 *
 * Maps to the official FireHydrant endpoint patch /v1/teams/{team_id}/support_hours_schedule.
 */
class FireHydrantUpdateSupportHoursSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_support_hours_schedule';
    protected const DESCRIPTION = 'Update support hours schedule

Official FireHydrant endpoint: PATCH /v1/teams/{team_id}/support_hours_schedule

Update the team\'s support hours schedule';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'team_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/teams/{team_id}/support_hours_schedule';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

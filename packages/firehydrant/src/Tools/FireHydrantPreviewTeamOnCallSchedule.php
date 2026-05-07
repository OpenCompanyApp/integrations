<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Preview a new on-call schedule for a team.
 *
 * Maps to the official FireHydrant endpoint post /v1/teams/{team_id}/on_call_schedules/preview.
 */
class FireHydrantPreviewTeamOnCallSchedule extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_preview_team_on_call_schedule';
    protected const DESCRIPTION = 'Preview a new on-call schedule for a team

Official FireHydrant endpoint: POST /v1/teams/{team_id}/on_call_schedules/preview

Preview a new on-call schedule based on the provided rotations, allowing you to see how the schedule will look before saving it.';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/teams/{team_id}/on_call_schedules/preview';
    protected const PATH_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

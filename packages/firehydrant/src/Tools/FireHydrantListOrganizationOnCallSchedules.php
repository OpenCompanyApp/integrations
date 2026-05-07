<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List who's on call for the organization.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals_on_call.
 */
class FireHydrantListOrganizationOnCallSchedules extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_organization_on_call_schedules';
    protected const DESCRIPTION = 'List who\'s on call for the organization

Official FireHydrant endpoint: GET /v1/signals_on_call

List all users who are currently on-call across the entire organization.';
    protected const PARAMETERS = array (
  'team_id' =>
  array (
    'type' => 'string',
    'description' => 'An optional comma separated list of team IDs to filter currently on-call users by',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals_on_call';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'team_id' => 'team_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

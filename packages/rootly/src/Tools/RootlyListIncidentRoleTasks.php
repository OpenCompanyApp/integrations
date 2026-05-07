<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident role tasks.
 *
 * Maps to the official Rootly endpoint get /v1/incident_roles/{incident_role_id}/incident_role_tasks.
 */
class RootlyListIncidentRoleTasks extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_role_tasks';
    protected const DESCRIPTION = 'List incident role tasks

Official Rootly endpoint: GET /v1/incident_roles/{incident_role_id}/incident_role_tasks

List incident_role tasks';
    protected const PARAMETERS = array (
  'incident_role_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_role_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_roles/{incident_role_id}/incident_role_tasks';
    protected const PATH_PARAMS = array (
  'incident_role_id' => 'incident_role_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves incident_sub_status.
 *
 * Maps to the official Rootly endpoint get /v1/incident_sub_statuses/{id}.
 */
class RootlyGetIncidentSubStatus extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_sub_status';
    protected const DESCRIPTION = 'Retrieves incident_sub_status

Official Rootly endpoint: GET /v1/incident_sub_statuses/{id}

Retrieves a specific incident_sub_status by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: sub_status,assigned_by_user',
    'enum' =>
    array (
      0 => 'sub_status',
      1 => 'assigned_by_user',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_sub_statuses/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

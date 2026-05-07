<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident_permission_set.
 *
 * Maps to the official Rootly endpoint put /v1/incident_permission_sets/{id}.
 */
class RootlyUpdateIncidentPermissionSet extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_permission_set';
    protected const DESCRIPTION = 'Update an incident_permission_set

Official Rootly endpoint: PUT /v1/incident_permission_sets/{id}

Update a specific incident_permission_set by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incident_permission_sets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

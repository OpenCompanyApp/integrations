<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident_permission_set_boolean.
 *
 * Maps to the official Rootly endpoint put /v1/incident_permission_set_booleans/{id}.
 */
class RootlyUpdateIncidentPermissionSetBoolean extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_permission_set_boolean';
    protected const DESCRIPTION = 'Update an incident_permission_set_boolean

Official Rootly endpoint: PUT /v1/incident_permission_set_booleans/{id}

Update a specific incident_permission_set_boolean by id';
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
    protected const PATH = '/v1/incident_permission_set_booleans/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

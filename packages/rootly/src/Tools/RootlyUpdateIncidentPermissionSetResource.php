<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident_permission_set_resource.
 *
 * Maps to the official Rootly endpoint put /v1/incident_permission_set_resources/{id}.
 */
class RootlyUpdateIncidentPermissionSetResource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_permission_set_resource';
    protected const DESCRIPTION = 'Update an incident_permission_set_resource

Official Rootly endpoint: PUT /v1/incident_permission_set_resources/{id}

Update a specific incident_permission_set_resource by id';
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
    protected const PATH = '/v1/incident_permission_set_resources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

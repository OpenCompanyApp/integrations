<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident_permission_set_resource.
 *
 * Maps to the official Rootly endpoint get /v1/incident_permission_set_resources/{id}.
 */
class RootlyGetIncidentPermissionSetResource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_permission_set_resource';
    protected const DESCRIPTION = 'Retrieves an incident_permission_set_resource

Official Rootly endpoint: GET /v1/incident_permission_set_resources/{id}

Retrieves a specific incident_permission_set_resource by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_permission_set_resources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident_permission_set_resource.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_permission_set_resources/{id}.
 */
class RootlyDeleteIncidentPermissionSetResource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_permission_set_resource';
    protected const DESCRIPTION = 'Delete an incident_permission_set_resource

Official Rootly endpoint: DELETE /v1/incident_permission_set_resources/{id}

Delete a specific incident_permission_set_resource by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

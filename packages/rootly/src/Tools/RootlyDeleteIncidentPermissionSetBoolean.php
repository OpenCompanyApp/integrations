<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident_permission_set_boolean.
 *
 * Maps to the official Rootly endpoint delete /v1/incident_permission_set_booleans/{id}.
 */
class RootlyDeleteIncidentPermissionSetBoolean extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_permission_set_boolean';
    protected const DESCRIPTION = 'Delete an incident_permission_set_boolean

Official Rootly endpoint: DELETE /v1/incident_permission_set_booleans/{id}

Delete a specific incident_permission_set_boolean by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incident_permission_set_booleans/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

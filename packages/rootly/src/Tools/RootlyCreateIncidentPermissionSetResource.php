<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident_permission_set_resource.
 *
 * Maps to the official Rootly endpoint post /v1/incident_permission_sets/{incident_permission_set_id}/resources.
 */
class RootlyCreateIncidentPermissionSetResource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_permission_set_resource';
    protected const DESCRIPTION = 'Creates an incident_permission_set_resource

Official Rootly endpoint: POST /v1/incident_permission_sets/{incident_permission_set_id}/resources

Creates a new incident_permission_set_resource from provided data';
    protected const PARAMETERS = array (
  'incident_permission_set_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_permission_set_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_permission_sets/{incident_permission_set_id}/resources';
    protected const PATH_PARAMS = array (
  'incident_permission_set_id' => 'incident_permission_set_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

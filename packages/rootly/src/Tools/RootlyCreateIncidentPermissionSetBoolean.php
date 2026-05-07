<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident_permission_set_boolean.
 *
 * Maps to the official Rootly endpoint post /v1/incident_permission_sets/{incident_permission_set_id}/booleans.
 */
class RootlyCreateIncidentPermissionSetBoolean extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_permission_set_boolean';
    protected const DESCRIPTION = 'Creates an incident_permission_set_boolean

Official Rootly endpoint: POST /v1/incident_permission_sets/{incident_permission_set_id}/booleans

Creates a new incident_permission_set_boolean from provided data';
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
    protected const PATH = '/v1/incident_permission_sets/{incident_permission_set_id}/booleans';
    protected const PATH_PARAMS = array (
  'incident_permission_set_id' => 'incident_permission_set_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

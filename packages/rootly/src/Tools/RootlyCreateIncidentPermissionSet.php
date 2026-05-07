<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident_permission_set.
 *
 * Maps to the official Rootly endpoint post /v1/incident_permission_sets.
 */
class RootlyCreateIncidentPermissionSet extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_permission_set';
    protected const DESCRIPTION = 'Creates an incident_permission_set

Official Rootly endpoint: POST /v1/incident_permission_sets

Creates a new incident_permission_set from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_permission_sets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

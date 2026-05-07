<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident role.
 *
 * Maps to the official Rootly endpoint put /v1/incident_roles/{id}.
 */
class RootlyUpdateIncidentRole extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_role';
    protected const DESCRIPTION = 'Update an incident role

Official Rootly endpoint: PUT /v1/incident_roles/{id}

Update a specific incident_role by id';
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
    protected const PATH = '/v1/incident_roles/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an incident role.
 *
 * Maps to the official FireHydrant endpoint patch /v1/incident_roles/{incident_role_id}.
 */
class FireHydrantUpdateIncidentRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_role';
    protected const DESCRIPTION = 'Update an incident role

Official FireHydrant endpoint: PATCH /v1/incident_roles/{incident_role_id}

Update a single incident role from its ID';
    protected const PARAMETERS = array (
  'incident_role_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_role_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/incident_roles/{incident_role_id}';
    protected const PATH_PARAMS = array (
  'incident_role_id' => 'incident_role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

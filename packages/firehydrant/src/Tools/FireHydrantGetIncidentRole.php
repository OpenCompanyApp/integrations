<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an incident role.
 *
 * Maps to the official FireHydrant endpoint get /v1/incident_roles/{incident_role_id}.
 */
class FireHydrantGetIncidentRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_role';
    protected const DESCRIPTION = 'Get an incident role

Official FireHydrant endpoint: GET /v1/incident_roles/{incident_role_id}

Retrieve a single incident role from its ID';
    protected const PARAMETERS = array (
  'incident_role_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_role_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_roles/{incident_role_id}';
    protected const PATH_PARAMS = array (
  'incident_role_id' => 'incident_role_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

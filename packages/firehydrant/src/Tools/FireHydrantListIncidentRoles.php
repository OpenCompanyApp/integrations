<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident roles.
 *
 * Maps to the official FireHydrant endpoint get /v1/incident_roles.
 */
class FireHydrantListIncidentRoles extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_roles';
    protected const DESCRIPTION = 'List incident roles

Official FireHydrant endpoint: GET /v1/incident_roles

List all of the incident roles in the organization';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

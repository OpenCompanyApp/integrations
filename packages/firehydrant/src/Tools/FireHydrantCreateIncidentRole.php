<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an incident role.
 *
 * Maps to the official FireHydrant endpoint post /v1/incident_roles.
 */
class FireHydrantCreateIncidentRole extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_role';
    protected const DESCRIPTION = 'Create an incident role

Official FireHydrant endpoint: POST /v1/incident_roles

Create a new incident role';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incident_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

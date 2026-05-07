<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get the current user's incident role.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/users/{user_id}.
 */
class FireHydrantGetIncidentUser extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_incident_user';
    protected const DESCRIPTION = 'Get the current user\'s incident role

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/users/{user_id}

Retrieve a user with current roles for an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/users/{user_id}';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

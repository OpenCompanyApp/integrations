<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get user by ID (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/users/{id}.
 */
class SnykGetUser extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_user';
    protected const DESCRIPTION = 'Get user by ID (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/users/{id}

Get a summary of user. Note that Service Accounts are not returned by this endpoint. Please use the Service Accounts endpoints. #### Required permissions - `View users (org.user.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Snyk API operation. The id of the user',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/users/{id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

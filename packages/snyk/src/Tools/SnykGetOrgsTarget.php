<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get target by target ID.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/targets/{target_id}.
 */
class SnykGetOrgsTarget extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_orgs_target';
    protected const DESCRIPTION = 'Get target by target ID

Official Snyk endpoint: GET /orgs/{org_id}/targets/{target_id}

Get a specified target for an organization. #### Required permissions - `View Projects (org.project.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org to return the target from',
  ),
  'target_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `target_id` from the official Snyk API operation. The id of the target to return',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/targets/{target_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'target_id' => 'target_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

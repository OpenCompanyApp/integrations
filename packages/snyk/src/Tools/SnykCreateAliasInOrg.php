<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Add alias for a repository asset in org (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/assets/repository/aliases.
 */
class SnykCreateAliasInOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_alias_in_org';
    protected const DESCRIPTION = 'Add alias for a repository asset in org (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/assets/repository/aliases

Link one or more alternate repository URLs to a canonical repository asset within an organisation, enabling alias-aware asset lookup. #### Required permissions - `Edit Organization (org.edit)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/assets/repository/aliases';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

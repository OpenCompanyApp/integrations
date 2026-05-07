<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Bulk remove aliases from repository assets in org (Early Access).
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/assets/repository/aliases.
 */
class SnykDeleteAliasesInOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_aliases_in_org';
    protected const DESCRIPTION = 'Bulk remove aliases from repository assets in org (Early Access)

Official Snyk endpoint: DELETE /orgs/{org_id}/assets/repository/aliases

Detach one or more aliased URLs from their canonical repository assets within an organisation. Each removed URL gets a new standalone asset document. #### Required permissions - `Edit Organization (org.edit)`';
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
    protected const METHOD = 'delete';
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

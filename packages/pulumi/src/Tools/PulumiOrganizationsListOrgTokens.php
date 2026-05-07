<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrgTokens.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/tokens.
 */
class PulumiOrganizationsListOrgTokens extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_org_tokens';
    protected const DESCRIPTION = 'ListOrgTokens

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/tokens

Retrieves all access tokens created for an organization. Organization tokens provide CI/CD automation access scoped to the organization rather than tied to individual user accounts. The response includes token metadata such as name, description, creation date, last used date, and expiration status. The actual token values are never returned after initial creation. An optional filter parameter can include expired tokens in the results.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `filter` from the official Pulumi Cloud API operation. Filter tokens by status (e.g., include expired tokens)',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/tokens';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'filter' => 'filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

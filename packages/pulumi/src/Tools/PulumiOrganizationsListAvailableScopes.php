<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListAvailableScopes.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/roles/scopes.
 */
class PulumiOrganizationsListAvailableScopes extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_available_scopes';
    protected const DESCRIPTION = 'ListAvailableScopes

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/roles/scopes

Returns all available permission scopes that can be assigned to custom roles, organized by category (e.g., stacks, teams, organization settings). Each scope represents a specific action or capability that can be granted or denied.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/roles/scopes';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

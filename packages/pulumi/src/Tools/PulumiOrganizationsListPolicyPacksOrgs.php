<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyPacks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policypacks.
 */
class PulumiOrganizationsListPolicyPacksOrgs extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_policy_packs_orgs';
    protected const DESCRIPTION = 'ListPolicyPacks

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policypacks

ListPolicyPacks returns a list of all complete Policy Packs for the organization. If the `policypack` query parameter is set, it will only list the policy packs with the specified name.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'policypack' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `policypack` from the official Pulumi Cloud API operation. The policy pack name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policypacks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'policypack' => 'policypack',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListPolicyGroups.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policygroups.
 */
class PulumiOrganizationsListPolicyGroups extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_list_policy_groups';
    protected const DESCRIPTION = 'ListPolicyGroups

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policygroups

Returns a list of all Policy Groups for the organization. Policy Groups define which Policy Packs are enforced on which stacks, with configurable enforcement levels (advisory, mandatory, or disabled) per pack. Every organization has a default Policy Group, and additional groups can be created to apply different policy sets to different environments (e.g., stricter enforcement in production).';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policygroups';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetPolicyGroup.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/policygroups/{policyGroup}.
 */
class PulumiOrganizationsGetPolicyGroup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_policy_group';
    protected const DESCRIPTION = 'GetPolicyGroup

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/policygroups/{policyGroup}

Returns the details of a specific Policy Group, including the list of Policy Packs applied to it and their enforcement levels (advisory, mandatory, or disabled), as well as the stacks or cloud accounts assigned to the group. Policy Groups enable targeted policy enforcement by associating sets of policies with specific infrastructure resources.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'policy_group' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `policyGroup` from the official Pulumi Cloud API operation. The policy group name',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/policygroups/{policyGroup}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'policyGroup' => 'policy_group',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

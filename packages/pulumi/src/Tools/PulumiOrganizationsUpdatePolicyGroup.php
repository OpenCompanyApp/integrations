<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdatePolicyGroup.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/policygroups/{policyGroup}.
 */
class PulumiOrganizationsUpdatePolicyGroup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_update_policy_group';
    protected const DESCRIPTION = 'UpdatePolicyGroup

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/policygroups/{policyGroup}

Updates a Policy Group\'s configuration. This multi-purpose endpoint supports several operations in a single request via different body fields: - `newName`: rename the policy group - `addStack` / `removeStack`: add or remove stacks (with `name` and `routingProject` fields) - `addPolicyPack` / `removePolicyPack`: add or remove policy packs (with `name`, `version`, `versionTag`, and optional `config`) - `addInsightsAccount` / `removeInsightsAccount`: add or remove Insights accounts Enforcement levels for policy packs are `advisory`, `mandatory`, or `disabled`.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

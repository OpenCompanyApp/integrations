<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeletePolicyGroup.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/policygroups/{policyGroup}.
 */
class PulumiOrganizationsDeletePolicyGroup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_delete_policy_group';
    protected const DESCRIPTION = 'DeletePolicyGroup

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/policygroups/{policyGroup}

Deletes a Policy Group from an organization. A Policy Group defines which Policy Packs are enforced on which stacks, with configurable enforcement levels (advisory, mandatory, or disabled) per pack. The organization\'s default Policy Group cannot be deleted. Deleting a Policy Group removes all policy enforcement associations for the stacks that were assigned to it.';
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
    protected const METHOD = 'delete';
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

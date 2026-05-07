<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * BatchUpdatePolicyGroup.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/policygroups/{policyGroup}/batch.
 */
class PulumiOrganizationsBatchUpdatePolicyGroup extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_batch_update_policy_group';
    protected const DESCRIPTION = 'BatchUpdatePolicyGroup

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/policygroups/{policyGroup}/batch

BatchUpdatePolicyGroup applies multiple update operations to the Policy Group efficiently. Each operation in the list uses the same fields as UpdatePolicyGroupRequest. Operations are grouped by type (adds, removes) and processed in batches for efficiency.';
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
    protected const PATH = '/api/orgs/{orgName}/policygroups/{policyGroup}/batch';
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

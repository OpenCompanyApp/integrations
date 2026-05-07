<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PatchOrgAgentPool.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/orgs/{orgName}/agent-pools/{poolId}.
 */
class PulumiWorkflowsPatchOrgAgentPool extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_workflows_patch_org_agent_pool';
    protected const DESCRIPTION = 'PatchOrgAgentPool

Official Pulumi Cloud endpoint: PATCH /api/orgs/{orgName}/agent-pools/{poolId}

Updates an existing agent pool\'s configuration for an organization. This can be used to modify the pool\'s name or other configurable properties. The request body uses the same format as CreateOrgAgentPool. Only provided fields are updated; omitted fields remain unchanged.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'pool_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `poolId` from the official Pulumi Cloud API operation. The agent pool identifier',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/orgs/{orgName}/agent-pools/{poolId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'poolId' => 'pool_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

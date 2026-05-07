<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteOrgAgentPool.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/orgs/{orgName}/agent-pools/{poolId}.
 */
class PulumiWorkflowsDeleteOrgAgentPool extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_workflows_delete_org_agent_pool';
    protected const DESCRIPTION = 'DeleteOrgAgentPool

Official Pulumi Cloud endpoint: DELETE /api/orgs/{orgName}/agent-pools/{poolId}

Deletes an agent pool from an organization. If the agent pool is currently referenced by any stack\'s deployment settings, the deletion will fail with a 400 error unless the \'force\' query parameter is set to true. Force-deleting a pool that is in use will cause affected stacks to fall back to Pulumi-managed infrastructure for future deployments. Returns 204 No Content on success.';
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
  'force' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `force` from the official Pulumi Cloud API operation. Force the operation even if the pool is in use',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/orgs/{orgName}/agent-pools/{poolId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'poolId' => 'pool_id',
);
    protected const QUERY_PARAMS = array (
  'force' => 'force',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

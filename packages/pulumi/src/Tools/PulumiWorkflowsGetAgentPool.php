<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetAgentPool.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/agent-pools/{poolId}.
 */
class PulumiWorkflowsGetAgentPool extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_workflows_get_agent_pool';
    protected const DESCRIPTION = 'GetAgentPool

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/agent-pools/{poolId}

Returns the details of a specific agent pool, including its name, ID, creation timestamp, and configuration. Agent pools enable self-hosted deployment agents that run Pulumi Deployments on organization-managed infrastructure. The pool ID can be referenced in stack deployment settings to route deployments to self-hosted agents instead of Pulumi-managed infrastructure.';
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
);
    protected const METHOD = 'get';
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

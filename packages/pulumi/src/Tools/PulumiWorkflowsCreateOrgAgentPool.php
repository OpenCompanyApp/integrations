<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateOrgAgentPool.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/orgs/{orgName}/agent-pools.
 */
class PulumiWorkflowsCreateOrgAgentPool extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_workflows_create_org_agent_pool';
    protected const DESCRIPTION = 'CreateOrgAgentPool

Official Pulumi Cloud endpoint: POST /api/orgs/{orgName}/agent-pools

Creates a new agent pool for an organization. Agent pools enable self-hosted deployment agents, allowing organizations to run Pulumi Deployments on their own infrastructure rather than Pulumi-managed infrastructure. This is useful for accessing private networks, meeting compliance requirements, or using custom execution environments. The response includes an access token (agent pool secret) that self-hosted agents use to authenticate when polling for deployment work. This token is only returned once at creation time and cannot be retrieved later.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/orgs/{orgName}/agent-pools';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

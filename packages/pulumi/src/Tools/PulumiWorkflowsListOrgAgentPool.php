<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrgAgentPool.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/agent-pools.
 */
class PulumiWorkflowsListOrgAgentPool extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_workflows_list_org_agent_pool';
    protected const DESCRIPTION = 'ListOrgAgentPool

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/agent-pools

Returns all agent pools configured for an organization. Agent pools enable self-hosted deployment agents, allowing organizations to run Pulumi Deployments on their own infrastructure for accessing private networks, meeting compliance requirements, or using custom execution environments. Each pool in the response includes its ID, name, and configuration details.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
);
    protected const METHOD = 'get';
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

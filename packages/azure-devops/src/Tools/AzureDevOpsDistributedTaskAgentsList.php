<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of agents..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId}/agents.
 */
class AzureDevOpsDistributedTaskAgentsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_agents_list';
    protected const DESCRIPTION = 'Get a list of agents.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId}/agents (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'pool_id' => ['type' => 'number', 'required' => true, 'description' => 'The agent pool containing the agents'], 'agent_name' => ['type' => 'string', 'required' => false, 'description' => 'Filter on agent name'], 'include_capabilities' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the agents\' capabilities in the response'], 'include_assigned_request' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include details about the agents\' current work'], 'include_last_completed_request' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include details about the agents\' most recent completed work'], 'property_filters' => ['type' => 'string', 'required' => false, 'description' => 'Filter which custom properties will be returned'], 'demands' => ['type' => 'string', 'required' => false, 'description' => 'Filter by demands the agents can satisfy'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/pools/{poolId}/agents';
    protected const PATH_PARAMS = ['organization' => 'organization', 'poolId' => 'pool_id'];
    protected const QUERY_PARAMS = ['agentName' => 'agent_name', 'includeCapabilities' => 'include_capabilities', 'includeAssignedRequest' => 'include_assigned_request', 'includeLastCompletedRequest' => 'include_last_completed_request', 'propertyFilters' => 'property_filters', 'demands' => 'demands', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

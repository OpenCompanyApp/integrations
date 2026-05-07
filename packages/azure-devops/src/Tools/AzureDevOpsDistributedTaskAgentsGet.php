<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get information about an agent..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId}/agents/{agentId}.
 */
class AzureDevOpsDistributedTaskAgentsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_agents_get';
    protected const DESCRIPTION = 'Get information about an agent.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId}/agents/{agentId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'pool_id' => ['type' => 'number', 'required' => true, 'description' => 'The agent pool containing the agent'], 'agent_id' => ['type' => 'number', 'required' => true, 'description' => 'The agent ID to get information about'], 'include_capabilities' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include the agent\'s capabilities in the response'], 'include_assigned_request' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include details about the agent\'s current work'], 'include_last_completed_request' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include details about the agents\' most recent completed work'], 'property_filters' => ['type' => 'string', 'required' => false, 'description' => 'Filter which custom properties will be returned'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/pools/{poolId}/agents/{agentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'poolId' => 'pool_id', 'agentId' => 'agent_id'];
    protected const QUERY_PARAMS = ['includeCapabilities' => 'include_capabilities', 'includeAssignedRequest' => 'include_assigned_request', 'includeLastCompletedRequest' => 'include_last_completed_request', 'propertyFilters' => 'property_filters', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

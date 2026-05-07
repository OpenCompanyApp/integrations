<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of agent queues by pool ids.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/queues.
 */
class AzureDevOpsDistributedTaskQueuesGetAgentQueuesForPools extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_queues_get_agent_queues_for_pools';
    protected const DESCRIPTION = 'Get a list of agent queues by pool ids

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/queues (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'pool_ids' => ['type' => 'string', 'required' => false, 'description' => 'A comma-separated list of pool ids to get the corresponding queues for'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'Filter by whether the calling user has use or manage permissions'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/queues';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['poolIds' => 'pool_ids', 'actionFilter' => 'action_filter', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

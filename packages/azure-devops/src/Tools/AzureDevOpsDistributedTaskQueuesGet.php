<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get information about an agent queue..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/queues/{queueId}.
 */
class AzureDevOpsDistributedTaskQueuesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_queues_get';
    protected const DESCRIPTION = 'Get information about an agent queue.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/queues/{queueId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'queue_id' => ['type' => 'number', 'required' => true, 'description' => 'The agent queue to get information about'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'Filter by whether the calling user has use or manage permissions'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/queues/{queueId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'queueId' => 'queue_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['actionFilter' => 'action_filter', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

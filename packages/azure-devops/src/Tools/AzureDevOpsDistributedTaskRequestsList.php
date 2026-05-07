<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/distributedtask/agentclouds/{agentCloudId}/requests.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/agentclouds/{agentCloudId}/requests.
 */
class AzureDevOpsDistributedTaskRequestsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_requests_list';
    protected const DESCRIPTION = 'GET /{organization}/_apis/distributedtask/agentclouds/{agentCloudId}/requests

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/agentclouds/{agentCloudId}/requests (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'agent_cloud_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `agentCloudId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/agentclouds/{agentCloudId}/requests';
    protected const PATH_PARAMS = ['organization' => 'organization', 'agentCloudId' => 'agent_cloud_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

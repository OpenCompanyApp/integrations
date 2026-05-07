<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * PATCH /{organization}/_apis/distributedtask/agentclouds/{agentCloudId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/distributedtask/agentclouds/{agentCloudId}.
 */
class AzureDevOpsDistributedTaskAgentcloudsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_agentclouds_update';
    protected const DESCRIPTION = 'PATCH /{organization}/_apis/distributedtask/agentclouds/{agentCloudId}

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/distributedtask/agentclouds/{agentCloudId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'agent_cloud_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `agentCloudId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/agentclouds/{agentCloudId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'agentCloudId' => 'agent_cloud_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

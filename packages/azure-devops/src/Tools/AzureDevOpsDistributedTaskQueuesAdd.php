<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a new agent queue to connect a project to an agent pool..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/distributedtask/queues.
 */
class AzureDevOpsDistributedTaskQueuesAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_queues_add';
    protected const DESCRIPTION = 'Create a new agent queue to connect a project to an agent pool.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/distributedtask/queues (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Details about the queue to create'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'authorize_pipelines' => ['type' => 'boolean', 'required' => false, 'description' => 'Automatically authorize this queue when using YAML'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/queues';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['authorizePipelines' => 'authorize_pipelines', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

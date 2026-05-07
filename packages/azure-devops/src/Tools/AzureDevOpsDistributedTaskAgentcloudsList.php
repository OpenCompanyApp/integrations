<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/distributedtask/agentclouds.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/agentclouds.
 */
class AzureDevOpsDistributedTaskAgentcloudsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_agentclouds_list';
    protected const DESCRIPTION = 'GET /{organization}/_apis/distributedtask/agentclouds

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/agentclouds (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/agentclouds';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

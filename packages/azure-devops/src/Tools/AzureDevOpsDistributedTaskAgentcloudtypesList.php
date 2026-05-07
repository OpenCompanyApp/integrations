<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get agent cloud types..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/agentcloudtypes.
 */
class AzureDevOpsDistributedTaskAgentcloudtypesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_agentcloudtypes_list';
    protected const DESCRIPTION = 'Get agent cloud types.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/agentcloudtypes (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/agentcloudtypes';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

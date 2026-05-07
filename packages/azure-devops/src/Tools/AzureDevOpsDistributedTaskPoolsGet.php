<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get information about an agent pool..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId}.
 */
class AzureDevOpsDistributedTaskPoolsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_pools_get';
    protected const DESCRIPTION = 'Get information about an agent pool.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'pool_id' => ['type' => 'number', 'required' => true, 'description' => 'An agent pool ID'], 'properties' => ['type' => 'string', 'required' => false, 'description' => 'Agent pool properties (comma-separated)'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'Filter by whether the calling user has use or manage permissions'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/pools/{poolId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'poolId' => 'pool_id'];
    protected const QUERY_PARAMS = ['properties' => 'properties', 'actionFilter' => 'action_filter', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

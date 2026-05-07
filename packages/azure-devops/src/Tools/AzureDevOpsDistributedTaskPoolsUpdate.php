<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update properties on an agent pool.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId}.
 */
class AzureDevOpsDistributedTaskPoolsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_pools_update';
    protected const DESCRIPTION = 'Update properties on an agent pool

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/distributedtask/pools/{poolId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Updated agent pool details'], 'pool_id' => ['type' => 'number', 'required' => true, 'description' => 'The agent pool to update'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/pools/{poolId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'poolId' => 'pool_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of ElasticNodes currently in the ElasticPool.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/distributedtask/elasticpools/{poolId}/nodes.
 */
class AzureDevOpsDistributedTaskNodesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_nodes_list';
    protected const DESCRIPTION = 'Get a list of ElasticNodes currently in the ElasticPool

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/distributedtask/elasticpools/{poolId}/nodes (spec: distributedTask/7.2/elastic.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'pool_id' => ['type' => 'number', 'required' => true, 'description' => 'Pool id of the ElasticPool'], 'state' => ['type' => 'string', 'required' => false, 'description' => 'Optional: Filter to only retrieve ElasticNodes in the given ElasticNodeState'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/elasticpools/{poolId}/nodes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'poolId' => 'pool_id'];
    protected const QUERY_PARAMS = ['$state' => 'state', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update properties on a specified ElasticNode.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/distributedtask/elasticpools/{poolId}/nodes/{elasticNodeId}.
 */
class AzureDevOpsDistributedTaskNodesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_nodes_update';
    protected const DESCRIPTION = 'Update properties on a specified ElasticNode

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/distributedtask/elasticpools/{poolId}/nodes/{elasticNodeId} (spec: distributedTask/7.2/elastic.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'pool_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `poolId`.'], 'elastic_node_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `elasticNodeId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/elasticpools/{poolId}/nodes/{elasticNodeId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'poolId' => 'pool_id', 'elasticNodeId' => 'elastic_node_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

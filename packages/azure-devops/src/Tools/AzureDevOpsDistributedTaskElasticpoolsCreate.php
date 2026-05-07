<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a new elastic pool. This will create a new TaskAgentPool at the organization level. If a project id is provided, this will create a new TaskAgentQueue in the specified project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/distributedtask/elasticpools.
 */
class AzureDevOpsDistributedTaskElasticpoolsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_elasticpools_create';
    protected const DESCRIPTION = 'Create a new elastic pool. This will create a new TaskAgentPool at the organization level. If a project id is provided, this will create a new TaskAgentQueue in the specified project.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/distributedtask/elasticpools (spec: distributedTask/7.2/elastic.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Elastic pool to create. Contains the properties necessary for configuring a new ElasticPool.'], 'pool_name' => ['type' => 'string', 'required' => false, 'description' => 'Name to use for the new TaskAgentPool'], 'authorize_all_pipelines' => ['type' => 'boolean', 'required' => false, 'description' => 'Setting to determine if all pipelines are authorized to use this TaskAgentPool by default.'], 'auto_provision_project_pools' => ['type' => 'boolean', 'required' => false, 'description' => 'Setting to automatically provision TaskAgentQueues in every project for the new pool.'], 'project_id' => ['type' => 'string', 'required' => false, 'description' => 'Optional: If provided, a new TaskAgentQueue will be created in the specified project.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/elasticpools';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['poolName' => 'pool_name', 'authorizeAllPipelines' => 'authorize_all_pipelines', 'autoProvisionProjectPools' => 'auto_provision_project_pools', 'projectId' => 'project_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

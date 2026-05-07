<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of deployment targets in a deployment group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}/targets.
 */
class AzureDevOpsDistributedTaskTargetsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_targets_list';
    protected const DESCRIPTION = 'Get a list of deployment targets in a deployment group.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}/targets (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'deployment_group_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the deployment group.'], 'tags' => ['type' => 'string', 'required' => false, 'description' => 'Get only the deployment targets that contain all these comma separted list of tags.'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'Name pattern of the deployment targets to return.'], 'partial_name_match' => ['type' => 'boolean', 'required' => false, 'description' => 'When set to true, treats **name** as pattern. Else treats it as absolute match. Default is **false**.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include these additional details in the returned objects.'], 'agent_status' => ['type' => 'string', 'required' => false, 'description' => 'Get only deployment targets that have this status.'], 'agent_job_result' => ['type' => 'string', 'required' => false, 'description' => 'Get only deployment targets that have this last job result.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Get deployment targets with names greater than this continuationToken lexicographically.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of deployment targets to return. Default is **1000**.'], 'enabled' => ['type' => 'boolean', 'required' => false, 'description' => 'Get only deployment targets that are enabled or disabled. Default is \'null\' which returns all the targets.'], 'property_filters' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `propertyFilters`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}/targets';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'deploymentGroupId' => 'deployment_group_id'];
    protected const QUERY_PARAMS = ['tags' => 'tags', 'name' => 'name', 'partialNameMatch' => 'partial_name_match', '$expand' => 'expand', 'agentStatus' => 'agent_status', 'agentJobResult' => 'agent_job_result', 'continuationToken' => 'continuation_token', '$top' => 'top', 'enabled' => 'enabled', 'propertyFilters' => 'property_filters', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

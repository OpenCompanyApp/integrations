<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of deployment groups by name or IDs..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups.
 */
class AzureDevOpsDistributedTaskDeploymentgroupsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_deploymentgroups_list';
    protected const DESCRIPTION = 'Get a list of deployment groups by name or IDs.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'Name of the deployment group.'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'Get only deployment groups on which this action can be performed.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include these additional details in the returned objects.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Get deployment groups with names greater than this continuationToken lexicographically.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of deployment groups to return. Default is **1000**.'], 'ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma separated list of IDs of the deployment groups.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/deploymentgroups';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['name' => 'name', 'actionFilter' => 'action_filter', '$expand' => 'expand', 'continuationToken' => 'continuation_token', '$top' => 'top', 'ids' => 'ids', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

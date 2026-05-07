<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a deployment group by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}.
 */
class AzureDevOpsDistributedTaskDeploymentgroupsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_deploymentgroups_get';
    protected const DESCRIPTION = 'Get a deployment group by its ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'deployment_group_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the deployment group.'], 'action_filter' => ['type' => 'string', 'required' => false, 'description' => 'Get the deployment group only if this action can be performed on it.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include these additional details in the returned object.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'deploymentGroupId' => 'deployment_group_id'];
    protected const QUERY_PARAMS = ['actionFilter' => 'action_filter', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

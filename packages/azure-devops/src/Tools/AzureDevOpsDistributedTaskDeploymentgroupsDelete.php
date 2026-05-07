<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a deployment group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}.
 */
class AzureDevOpsDistributedTaskDeploymentgroupsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_deploymentgroups_delete';
    protected const DESCRIPTION = 'Delete a deployment group.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'deployment_group_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the deployment group to be deleted.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/deploymentgroups/{deploymentGroupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'deploymentGroupId' => 'deployment_group_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a variable group.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/distributedtask/variablegroups/{groupId}.
 */
class AzureDevOpsDistributedTaskVariablegroupsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_variablegroups_delete';
    protected const DESCRIPTION = 'Delete a variable group

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/distributedtask/variablegroups/{groupId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the variable group.'], 'project_ids' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `projectIds`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/distributedtask/variablegroups/{groupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupId' => 'group_id'];
    protected const QUERY_PARAMS = ['projectIds' => 'project_ids', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

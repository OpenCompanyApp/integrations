<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a variable group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/variablegroups/{groupId}.
 */
class AzureDevOpsDistributedTaskVariablegroupsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_variablegroups_get';
    protected const DESCRIPTION = 'Get a variable group.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/variablegroups/{groupId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'group_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the variable group.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/variablegroups/{groupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'groupId' => 'group_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a task group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/distributedtask/taskgroups/{taskGroupId}.
 */
class AzureDevOpsDistributedTaskTaskgroupsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_taskgroups_update';
    protected const DESCRIPTION = 'Update a task group.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/distributedtask/taskgroups/{taskGroupId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Task group to update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'task_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the task group to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/taskgroups/{taskGroupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'taskGroupId' => 'task_group_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

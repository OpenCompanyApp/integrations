<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * List task groups..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/taskgroups/{taskGroupId}.
 */
class AzureDevOpsDistributedTaskTaskgroupsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_taskgroups_list';
    protected const DESCRIPTION = 'List task groups.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/taskgroups/{taskGroupId} (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'task_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the task group.'], 'expanded' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\' to recursively expand task groups. Default is \'false\'.'], 'task_id_filter' => ['type' => 'string', 'required' => false, 'description' => 'Guid of the taskId to filter.'], 'deleted' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\'to include deleted task groups. Default is \'false\'.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of task groups to get.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Gets the task groups after the continuation token provided.'], 'query_order' => ['type' => 'string', 'required' => false, 'description' => 'Gets the results in the defined order. Default is \'CreatedOnDescending\'.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/taskgroups/{taskGroupId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'taskGroupId' => 'task_group_id'];
    protected const QUERY_PARAMS = ['expanded' => 'expanded', 'taskIdFilter' => 'task_id_filter', 'deleted' => 'deleted', '$top' => 'top', 'continuationToken' => 'continuation_token', 'queryOrder' => 'query_order', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

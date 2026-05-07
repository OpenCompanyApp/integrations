<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get variable groups by ids..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/variablegroups.
 */
class AzureDevOpsDistributedTaskVariablegroupsGetVariableGroupsById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_distributed_task_variablegroups_get_variable_groups_by_id';
    protected const DESCRIPTION = 'Get variable groups by ids.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/distributedtask/variablegroups (spec: distributedTask/7.2/taskAgent.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'group_ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma separated list of Ids of variable groups.'], 'load_secrets' => ['type' => 'boolean', 'required' => false, 'description' => 'Flag indicating if the secrets within variable groups should be loaded.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/distributedtask/variablegroups';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['groupIds' => 'group_ids', 'loadSecrets' => 'load_secrets', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

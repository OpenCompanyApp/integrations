<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Virtual Machine Resources.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/virtualmachines.
 */
class AzureDevOpsEnvironmentsVmresourceList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_vmresource_list';
    protected const DESCRIPTION = 'Get Virtual Machine Resources

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/virtualmachines (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'environment_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the Environment'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'Name of the Virtual Machine Resource'], 'tags' => ['type' => 'string', 'required' => false, 'description' => 'Tags of the Virtual Machine Resource'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Gets the Virtual Machine Resources after the continuation token provided.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of Virtual Machine Resources to get. Default is 1000.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments/{environmentId}/providers/virtualmachines';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'environmentId' => 'environment_id'];
    protected const QUERY_PARAMS = ['name' => 'name', 'tags' => 'tags', 'continuationToken' => 'continuation_token', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

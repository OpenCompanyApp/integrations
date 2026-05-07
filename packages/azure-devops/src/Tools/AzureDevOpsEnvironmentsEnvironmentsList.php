<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all environments..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments.
 */
class AzureDevOpsEnvironmentsEnvironmentsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_environments_environments_list';
    protected const DESCRIPTION = 'Get all environments.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/environments (spec: environments/7.2/environments.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'name' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `name`.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `continuationToken`.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/environments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['name' => 'name', 'continuationToken' => 'continuation_token', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

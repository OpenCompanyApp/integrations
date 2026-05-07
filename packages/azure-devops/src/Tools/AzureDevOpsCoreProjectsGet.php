<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get project with the specified id or name, optionally including capabilities..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects/{projectId}.
 */
class AzureDevOpsCoreProjectsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_get';
    protected const DESCRIPTION = 'Get project with the specified id or name, optionally including capabilities.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects/{projectId} (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `projectId`.'], 'include_capabilities' => ['type' => 'boolean', 'required' => false, 'description' => 'Include capabilities (such as source control) in the team project result (default: false).'], 'include_history' => ['type' => 'boolean', 'required' => false, 'description' => 'Search within renamed projects (that had such name in the past).'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['includeCapabilities' => 'include_capabilities', 'includeHistory' => 'include_history', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

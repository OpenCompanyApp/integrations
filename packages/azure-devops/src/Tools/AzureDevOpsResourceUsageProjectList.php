<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the Project Level limits and Usage for a project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/resourceusage.
 */
class AzureDevOpsResourceUsageProjectList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_resource_usage_project_list';
    protected const DESCRIPTION = 'Gets the Project Level limits and Usage for a project.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/resourceusage (spec: resourceUsage/7.2/resourceUsage.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.1-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/resourceusage';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.1-preview.1';
}

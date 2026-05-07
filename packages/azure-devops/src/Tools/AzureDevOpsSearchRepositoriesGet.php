<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Provides status of Repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://almsearch.dev.azure.com/{organization}/{project}/_apis/search/status/repositories/{repository}.
 */
class AzureDevOpsSearchRepositoriesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_search_repositories_get';
    protected const DESCRIPTION = 'Provides status of Repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://almsearch.dev.azure.com/{organization}/{project}/_apis/search/status/repositories/{repository} (spec: search/7.2/search.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'Repository ID or repository name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'almsearch.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/search/status/repositories/{repository}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

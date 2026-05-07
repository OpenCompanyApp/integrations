<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve import requests for a repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/importRequests.
 */
class AzureDevOpsGitImportRequestsQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_import_requests_query';
    protected const DESCRIPTION = 'Retrieve import requests for a repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/importRequests (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'include_abandoned' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include abandoned import requests in the results.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/importRequests';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryId' => 'repository_id'];
    protected const QUERY_PARAMS = ['includeAbandoned' => 'include_abandoned', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

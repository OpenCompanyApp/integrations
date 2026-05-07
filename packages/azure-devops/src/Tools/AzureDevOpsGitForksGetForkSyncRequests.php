<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve all requested fork sync operations on this repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests.
 */
class AzureDevOpsGitForksGetForkSyncRequests extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_forks_get_fork_sync_requests';
    protected const DESCRIPTION = 'Retrieve all requested fork sync operations on this repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_name_or_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_abandoned' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include abandoned requests.'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include links.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryNameOrId' => 'repository_name_or_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeAbandoned' => 'include_abandoned', 'includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

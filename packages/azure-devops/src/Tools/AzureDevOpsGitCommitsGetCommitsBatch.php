<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve git commits for a project matching the search criteria.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commitsbatch.
 */
class AzureDevOpsGitCommitsGetCommitsBatch extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_commits_get_commits_batch';
    protected const DESCRIPTION = 'Retrieve git commits for a project matching the search criteria

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commitsbatch (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Search options'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of commits to skip. The value cannot exceed 3,000,000.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of commits to return. The value cannot exceed 50,000.'], 'include_statuses' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include additional commit status information.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/commitsbatch';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$skip' => 'skip', '$top' => 'top', 'includeStatuses' => 'include_statuses', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

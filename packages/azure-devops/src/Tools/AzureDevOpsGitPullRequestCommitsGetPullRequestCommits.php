<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the commits for the specified pull request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/commits.
 */
class AzureDevOpsGitPullRequestCommitsGetPullRequestCommits extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_commits_get_pull_request_commits';
    protected const DESCRIPTION = 'Get the commits for the specified pull request.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/commits (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID or name of the repository.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of commits to return.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'The continuation token used for pagination.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/commits';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$top' => 'top', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

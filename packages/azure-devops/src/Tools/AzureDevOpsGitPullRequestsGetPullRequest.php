<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve a pull request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests/{pullRequestId}.
 */
class AzureDevOpsGitPullRequestsGetPullRequest extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_requests_get_pull_request';
    protected const DESCRIPTION = 'Retrieve a pull request.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests/{pullRequestId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request\'s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the pull request to retrieve.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'max_comment_length' => ['type' => 'number', 'required' => false, 'description' => 'Not used.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Not used.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Not used.'], 'include_commits' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, the pull request will be returned with the associated commits.'], 'include_work_item_refs' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, the pull request will be returned with the associated work item references.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests/{pullRequestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['maxCommentLength' => 'max_comment_length', '$skip' => 'skip', '$top' => 'top', 'includeCommits' => 'include_commits', 'includeWorkItemRefs' => 'include_work_item_refs', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

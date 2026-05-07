<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add a reviewer to a pull request or cast a vote..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/reviewers/{reviewerId}.
 */
class AzureDevOpsGitPullRequestReviewersCreatePullRequestReviewer extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_reviewers_create_pull_request_reviewer';
    protected const DESCRIPTION = 'Add a reviewer to a pull request or cast a vote.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/reviewers/{reviewerId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Reviewer\'s vote.<br />If the reviewer\'s ID is included here, it must match the reviewerID parameter.<br />Reviewers can set their own vote with this method. When adding other reviewers, vote must be set to zero.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request\'s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'reviewer_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the reviewer.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/reviewers/{reviewerId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'reviewerId' => 'reviewer_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

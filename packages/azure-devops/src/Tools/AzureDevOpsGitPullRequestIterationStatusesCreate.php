<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a pull request status on the iteration. This operation will have the same result as Create status on pull request with specified iteration ID in the request body. The only required field for the status is `Context.Name` that uniquely identifies the status. Note that `iterationId` in the request body is optional since `iterationId` can be specified in the URL. A conflict between `iterationId` in the URL and `iterationId` in the request body will result in status code 400..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/statuses.
 */
class AzureDevOpsGitPullRequestIterationStatusesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_iteration_statuses_create';
    protected const DESCRIPTION = 'Create a pull request status on the iteration. This operation will have the same result as Create status on pull request with specified iteration ID in the request body. The only required field for the status is `Context.Name` that uniquely identifies the status. Note that `iterationId` in the request body is optional since `iterationId` can be specified in the URL. A conflict between `iterationId` in the URL and `iterationId` in the request body will result in status code 400.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/statuses (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Pull request status to create.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request’s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'iteration_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request iteration.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/statuses';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'iterationId' => 'iteration_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

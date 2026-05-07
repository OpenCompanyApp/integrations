<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update pull request iteration statuses collection. The only supported operation type is `remove`. This operation allows to delete multiple statuses in one call. The path of the `remove` operation should refer to the ID of the pull request status. For example `path="/1"` refers to the pull request status with ID 1..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/statuses.
 */
class AzureDevOpsGitPullRequestIterationStatusesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_iteration_statuses_update';
    protected const DESCRIPTION = 'Update pull request iteration statuses collection. The only supported operation type is `remove`. This operation allows to delete multiple statuses in one call. The path of the `remove` operation should refer to the ID of the pull request status. For example `path="/1"` refers to the pull request status with ID 1.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/statuses (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Operations to apply to the pull request statuses in JSON Patch format.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request’s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'iteration_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request iteration.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/statuses';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'iterationId' => 'iteration_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a pull request These are the properties that can be updated with the API: - Status - Title - Description (up to 4000 characters) - CompletionOptions - MergeOptions - AutoCompleteSetBy.Id - TargetRefName (when the PR retargeting feature is enabled) Attempting to update other properties outside of this list will either cause the server to throw an `InvalidArgumentValueException`, or to silently ignore the update..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests/{pullRequestId}.
 */
class AzureDevOpsGitPullRequestsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_requests_update';
    protected const DESCRIPTION = 'Update a pull request These are the properties that can be updated with the API: - Status - Title - Description (up to 4000 characters) - CompletionOptions - MergeOptions - AutoCompleteSetBy.Id - TargetRefName (when the PR retargeting feature is enabled) Attempting to update other properties outside of this list will either cause the server to throw an `InvalidArgumentValueException`, or to silently ignore the update.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests/{pullRequestId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The pull request content that should be updated.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request\'s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request to update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests/{pullRequestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

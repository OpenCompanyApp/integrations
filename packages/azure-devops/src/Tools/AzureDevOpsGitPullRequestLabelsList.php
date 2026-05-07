<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all the labels (tags) assigned to a pull request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/labels.
 */
class AzureDevOpsGitPullRequestLabelsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_labels_list';
    protected const DESCRIPTION = 'Get all the labels (tags) assigned to a pull request.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/labels (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request’s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'project_id' => ['type' => 'string', 'required' => false, 'description' => 'Project ID or project name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/labels';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['projectId' => 'project_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

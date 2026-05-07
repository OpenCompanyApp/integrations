<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a pull request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests.
 */
class AzureDevOpsGitPullRequestsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_requests_create';
    protected const DESCRIPTION = 'Create a pull request.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The pull request to create.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request\'s target branch.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'supports_iterations' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, subsequent pushes to the pull request will be individually reviewable. Set this to false for large pull requests for performance reasons if this functionality is not needed.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequests';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['supportsIterations' => 'supports_iterations', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

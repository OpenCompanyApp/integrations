<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve a pull request..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/pullrequests/{pullRequestId}.
 */
class AzureDevOpsGitPullRequestsGetPullRequestById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_requests_get_pull_request_by_id';
    protected const DESCRIPTION = 'Retrieve a pull request.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/pullrequests/{pullRequestId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the pull request to retrieve.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/pullrequests/{pullRequestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'pullRequestId' => 'pull_request_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

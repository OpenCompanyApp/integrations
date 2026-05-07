<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve a list of commits associated with a particular push..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits.
 */
class AzureDevOpsGitCommitsGetPushCommits extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_commits_get_push_commits';
    protected const DESCRIPTION = 'Retrieve a list of commits associated with a particular push.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The id or friendly name of the repository. To use the friendly name, projectId must also be specified.'], 'push_id' => ['type' => 'number', 'required' => false, 'description' => 'The id of the push.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'The maximum number of commits to return ("get the top x commits").'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'The number of commits to skip.'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to false to avoid including REST Url links for resources. Defaults to true.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['pushId' => 'push_id', 'top' => 'top', 'skip' => 'skip', 'includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

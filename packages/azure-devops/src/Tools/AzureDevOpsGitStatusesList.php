<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get statuses associated with the Git commit..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}/statuses.
 */
class AzureDevOpsGitStatusesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_statuses_list';
    protected const DESCRIPTION = 'Get statuses associated with the Git commit.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}/statuses (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'commit_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the Git commit.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Optional. The number of statuses to retrieve. Default is 1000.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Optional. The number of statuses to ignore. Default is 0. For example, to retrieve results 101-150, set top to 50 and skip to 100.'], 'latest_only' => ['type' => 'boolean', 'required' => false, 'description' => 'The flag indicates whether to get only latest statuses grouped by `Context.Name` and `Context.Genre`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}/statuses';
    protected const PATH_PARAMS = ['organization' => 'organization', 'commitId' => 'commit_id', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['top' => 'top', 'skip' => 'skip', 'latestOnly' => 'latest_only', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

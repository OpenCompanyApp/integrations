<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve a particular commit..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}.
 */
class AzureDevOpsGitCommitsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_commits_get';
    protected const DESCRIPTION = 'Retrieve a particular commit.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'commit_id' => ['type' => 'string', 'required' => true, 'description' => 'The id of the commit.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The id or friendly name of the repository. To use the friendly name, projectId must also be specified.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'change_count' => ['type' => 'number', 'required' => false, 'description' => 'The number of changes to include in the result.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'commitId' => 'commit_id', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['changeCount' => 'change_count', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

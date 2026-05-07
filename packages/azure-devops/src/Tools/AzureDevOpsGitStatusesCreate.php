<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create Git commit status..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}/statuses.
 */
class AzureDevOpsGitStatusesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_statuses_create';
    protected const DESCRIPTION = 'Create Git commit status.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}/statuses (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Git commit status object to create.'], 'commit_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the Git commit.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/commits/{commitId}/statuses';
    protected const PATH_PARAMS = ['organization' => 'organization', 'commitId' => 'commit_id', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates the Git repository with either a new repo name or a new default branch..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}.
 */
class AzureDevOpsGitRepositoriesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_repositories_update';
    protected const DESCRIPTION = 'Updates the Git repository with either a new repo name or a new default branch.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Specify a new repo name or a new default branch of the repository'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

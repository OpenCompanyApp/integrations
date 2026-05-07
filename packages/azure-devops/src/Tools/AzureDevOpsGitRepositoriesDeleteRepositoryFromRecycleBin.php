<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Destroy (hard delete) a soft-deleted Git repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/git/recycleBin/repositories/{repositoryId}.
 */
class AzureDevOpsGitRepositoriesDeleteRepositoryFromRecycleBin extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_repositories_delete_repository_from_recycle_bin';
    protected const DESCRIPTION = 'Destroy (hard delete) a soft-deleted Git repository.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/git/recycleBin/repositories/{repositoryId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/recycleBin/repositories/{repositoryId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryId' => 'repository_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Recover a soft-deleted Git repository. Recently deleted repositories go into a soft-delete state for a period of time before they are hard deleted and become unrecoverable..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/git/recycleBin/repositories/{repositoryId}.
 */
class AzureDevOpsGitRepositoriesRestoreRepositoryFromRecycleBin extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_repositories_restore_repository_from_recycle_bin';
    protected const DESCRIPTION = 'Recover a soft-deleted Git repository. Recently deleted repositories go into a soft-delete state for a period of time before they are hard deleted and become unrecoverable.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/git/recycleBin/repositories/{repositoryId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the repository.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/recycleBin/repositories/{repositoryId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryId' => 'repository_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

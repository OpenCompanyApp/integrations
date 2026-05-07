<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve soft-deleted git repositories from the recycle bin..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/recycleBin/repositories.
 */
class AzureDevOpsGitRepositoriesGetRecycleBinRepositories extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_repositories_get_recycle_bin_repositories';
    protected const DESCRIPTION = 'Retrieve soft-deleted git repositories from the recycle bin.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/recycleBin/repositories (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/recycleBin/repositories';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

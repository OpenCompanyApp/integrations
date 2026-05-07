<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve a pull request suggestion for a particular repository or team project..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/suggestions.
 */
class AzureDevOpsGitSuggestionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_suggestions_list';
    protected const DESCRIPTION = 'Retrieve a pull request suggestion for a particular repository or team project.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/suggestions (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the git repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'prefer_compare_branch' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, prefer the compare branch over the default branch as target branch for pull requests.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/suggestions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['preferCompareBranch' => 'prefer_compare_branch', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

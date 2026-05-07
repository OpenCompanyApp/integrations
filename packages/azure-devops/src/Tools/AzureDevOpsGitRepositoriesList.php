<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve git repositories..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories.
 */
class AzureDevOpsGitRepositoriesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_repositories_list';
    protected const DESCRIPTION = 'Retrieve git repositories.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] True to include reference links. The default value is false.'], 'include_all_urls' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] True to include all remote URLs. The default value is false.'], 'include_hidden' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] True to include hidden repositories. The default value is false.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeLinks' => 'include_links', 'includeAllUrls' => 'include_all_urls', 'includeHidden' => 'include_hidden', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

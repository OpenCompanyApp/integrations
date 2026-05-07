<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the refs favorites for a repo and an identity..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/favorites/refs.
 */
class AzureDevOpsGitRefsFavoritesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_refs_favorites_list';
    protected const DESCRIPTION = 'Gets the refs favorites for a repo and an identity.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/favorites/refs (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_id' => ['type' => 'string', 'required' => false, 'description' => 'The id of the repository.'], 'identity_id' => ['type' => 'string', 'required' => false, 'description' => 'The id of the identity whose favorites are to be retrieved. If null, the requesting identity is used.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/favorites/refs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['repositoryId' => 'repository_id', 'identityId' => 'identity_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

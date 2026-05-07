<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes the refs favorite specified.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/git/favorites/refs/{favoriteId}.
 */
class AzureDevOpsGitRefsFavoritesDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_refs_favorites_delete';
    protected const DESCRIPTION = 'Deletes the refs favorite specified

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/git/favorites/refs/{favoriteId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'favorite_id' => ['type' => 'number', 'required' => true, 'description' => 'The Id of the ref favorite to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/favorites/refs/{favoriteId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'favoriteId' => 'favorite_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

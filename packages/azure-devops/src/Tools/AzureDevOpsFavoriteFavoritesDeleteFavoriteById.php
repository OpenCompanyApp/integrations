<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * DELETE /{organization}/_apis/favorite/favorites/{favoriteId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/_apis/favorite/favorites/{favoriteId}.
 */
class AzureDevOpsFavoriteFavoritesDeleteFavoriteById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_favorite_favorites_delete_favorite_by_id';
    protected const DESCRIPTION = 'DELETE /{organization}/_apis/favorite/favorites/{favoriteId}

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/_apis/favorite/favorites/{favoriteId} (spec: favorite/7.2/favorite.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'favorite_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `favoriteId`.'], 'artifact_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactType`.'], 'artifact_scope_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactScopeType`.'], 'artifact_scope_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactScopeId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/favorite/favorites/{favoriteId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'favoriteId' => 'favorite_id'];
    protected const QUERY_PARAMS = ['artifactType' => 'artifact_type', 'artifactScopeType' => 'artifact_scope_type', 'artifactScopeId' => 'artifact_scope_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

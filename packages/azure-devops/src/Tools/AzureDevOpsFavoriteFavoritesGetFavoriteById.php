<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/favorite/favorites/{favoriteId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/favorite/favorites/{favoriteId}.
 */
class AzureDevOpsFavoriteFavoritesGetFavoriteById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_favorite_favorites_get_favorite_by_id';
    protected const DESCRIPTION = 'GET /{organization}/_apis/favorite/favorites/{favoriteId}

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/favorite/favorites/{favoriteId} (spec: favorite/7.2/favorite.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'favorite_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `favoriteId`.'], 'artifact_scope_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactScopeType`.'], 'artifact_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactType`.'], 'artifact_scope_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactScopeId`.'], 'include_extended_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeExtendedDetails`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/favorite/favorites/{favoriteId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'favoriteId' => 'favorite_id'];
    protected const QUERY_PARAMS = ['artifactScopeType' => 'artifact_scope_type', 'artifactType' => 'artifact_type', 'artifactScopeId' => 'artifact_scope_id', 'includeExtendedDetails' => 'include_extended_details', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

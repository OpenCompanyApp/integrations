<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/favorite/favorites.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/favorite/favorites.
 */
class AzureDevOpsFavoriteFavoritesGetFavorites extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_favorite_favorites_get_favorites';
    protected const DESCRIPTION = 'GET /{organization}/_apis/favorite/favorites

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/favorite/favorites (spec: favorite/7.2/favorite.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'artifact_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactType`.'], 'artifact_scope_type' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactScopeType`.'], 'artifact_scope_id' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `artifactScopeId`.'], 'include_extended_details' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeExtendedDetails`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/favorite/favorites';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['artifactType' => 'artifact_type', 'artifactScopeType' => 'artifact_scope_type', 'artifactScopeId' => 'artifact_scope_id', 'includeExtendedDetails' => 'include_extended_details', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all projects in the organization that the authenticated user has access to..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects.
 */
class AzureDevOpsCoreProjectsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_projects_list';
    protected const DESCRIPTION = 'Get all projects in the organization that the authenticated user has access to.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'state_filter' => ['type' => 'string', 'required' => false, 'description' => 'Filter on team projects in a specific team project state (default: WellFormed).'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'continuation_token' => ['type' => 'number', 'required' => false, 'description' => 'Pointer that shows how many projects already been fetched.'], 'get_default_team_image_url' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `getDefaultTeamImageUrl`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['stateFilter' => 'state_filter', '$top' => 'top', '$skip' => 'skip', 'continuationToken' => 'continuation_token', 'getDefaultTeamImageUrl' => 'get_default_team_image_url', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific team..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams/{teamId}.
 */
class AzureDevOpsCoreTeamsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_teams_get';
    protected const DESCRIPTION = 'Get a specific team.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams/{teamId} (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team project containing the team.'], 'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team.'], 'expand_identity' => ['type' => 'boolean', 'required' => false, 'description' => 'A value indicating whether or not to expand Identity information in the result WebApiTeam object.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/teams/{teamId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id', 'teamId' => 'team_id'];
    protected const QUERY_PARAMS = ['$expandIdentity' => 'expand_identity', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

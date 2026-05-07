<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of teams..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams.
 */
class AzureDevOpsCoreTeamsGetTeams extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_teams_get_teams';
    protected const DESCRIPTION = 'Get a list of teams.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `projectId`.'], 'mine' => ['type' => 'boolean', 'required' => false, 'description' => 'If true return all the teams requesting user is member, otherwise return all the teams user has read access.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of teams to return.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of teams to skip.'], 'expand_identity' => ['type' => 'boolean', 'required' => false, 'description' => 'A value indicating whether or not to expand Identity information in the result WebApiTeam object.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/teams';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['$mine' => 'mine', '$top' => 'top', '$skip' => 'skip', '$expandIdentity' => 'expand_identity', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

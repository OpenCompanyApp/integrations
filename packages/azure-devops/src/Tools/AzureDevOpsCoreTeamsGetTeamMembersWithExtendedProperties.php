<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of members for a specific team..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams/{teamId}/members.
 */
class AzureDevOpsCoreTeamsGetTeamMembersWithExtendedProperties extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_teams_get_team_members_with_extended_properties';
    protected const DESCRIPTION = 'Get a list of members for a specific team.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams/{teamId}/members (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team project the team belongs to.'], 'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team .'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/teams/{teamId}/members';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id', 'teamId' => 'team_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

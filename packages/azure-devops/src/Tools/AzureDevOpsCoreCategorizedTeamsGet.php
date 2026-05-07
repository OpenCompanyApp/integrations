<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets list of user readable teams in a project and teams user is member of (excluded from readable list)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/categorizedteams/.
 */
class AzureDevOpsCoreCategorizedTeamsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_categorized_teams_get';
    protected const DESCRIPTION = 'Gets list of user readable teams in a project and teams user is member of (excluded from readable list).

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/projects/{projectId}/categorizedteams/ (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team project containing the teams to retrieve.'], 'expand_identity' => ['type' => 'boolean', 'required' => false, 'description' => 'A value indicating whether or not to expand Identity information in the result WebApiTeam object.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of teams to return.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of teams to skip.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/categorizedteams/';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['$expandIdentity' => 'expand_identity', '$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

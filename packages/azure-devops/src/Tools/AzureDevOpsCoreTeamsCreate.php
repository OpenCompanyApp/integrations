<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a team in a team project. Possible failure scenarios Invalid project name/ID (project doesn't exist) 404 Invalid team name or description 400 Team already exists 400 Insufficient privileges 400.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams.
 */
class AzureDevOpsCoreTeamsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_teams_create';
    protected const DESCRIPTION = 'Create a team in a team project. Possible failure scenarios Invalid project name/ID (project doesn\'t exist) 404 Invalid team name or description 400 Team already exists 400 Insufficient privileges 400

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The team data used to create the team.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team project in which to create the team.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/teams';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

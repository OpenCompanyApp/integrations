<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a team's name and/or description..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams/{teamId}.
 */
class AzureDevOpsCoreTeamsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_core_teams_update';
    protected const DESCRIPTION = 'Update a team\'s name and/or description.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/_apis/projects/{projectId}/teams/{teamId} (spec: core/7.2/core.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID (GUID) of the team project containing the team to update.'], 'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The name of ID of the team to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/projects/{projectId}/teams/{teamId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'projectId' => 'project_id', 'teamId' => 'team_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add an iteration to the team.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations.
 */
class AzureDevOpsWorkIterationsPostTeamIteration extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_iterations_post_team_iteration';
    protected const DESCRIPTION = 'Add an iteration to the team

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Iteration to add'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/teamsettings/iterations';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

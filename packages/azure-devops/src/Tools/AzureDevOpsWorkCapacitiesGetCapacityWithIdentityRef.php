<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a team member's capacity.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/capacities/{teamMemberId}.
 */
class AzureDevOpsWorkCapacitiesGetCapacityWithIdentityRef extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_capacities_get_capacity_with_identity_ref';
    protected const DESCRIPTION = 'Get a team member\'s capacity

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/capacities/{teamMemberId} (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'iteration_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the iteration'], 'team_member_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the team member'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/capacities/{teamMemberId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'iterationId' => 'iteration_id', 'teamMemberId' => 'team_member_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

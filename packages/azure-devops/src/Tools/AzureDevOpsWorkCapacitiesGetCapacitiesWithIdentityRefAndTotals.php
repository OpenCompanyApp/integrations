<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a team's capacity including total capacity and days off.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/capacities.
 */
class AzureDevOpsWorkCapacitiesGetCapacitiesWithIdentityRefAndTotals extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_capacities_get_capacities_with_identity_ref_and_totals';
    protected const DESCRIPTION = 'Get a team\'s capacity including total capacity and days off

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/capacities (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'iteration_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the iteration'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/capacities';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'iterationId' => 'iteration_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

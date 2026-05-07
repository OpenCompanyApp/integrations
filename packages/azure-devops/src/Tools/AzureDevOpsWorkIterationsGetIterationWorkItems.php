<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get work items for iteration.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/workitems.
 */
class AzureDevOpsWorkIterationsGetIterationWorkItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_iterations_get_iteration_work_items';
    protected const DESCRIPTION = 'Get work items for iteration

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/workitems (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'iteration_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the iteration'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/teamsettings/iterations/{iterationId}/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'iterationId' => 'iteration_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

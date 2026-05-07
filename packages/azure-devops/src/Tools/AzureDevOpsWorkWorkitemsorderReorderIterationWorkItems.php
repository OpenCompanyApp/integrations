<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Reorder Sprint Backlog/Taskboard Work Items.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/{team}/_apis/work/iterations/{iterationId}/workitemsorder.
 */
class AzureDevOpsWorkWorkitemsorderReorderIterationWorkItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_workitemsorder_reorder_iteration_work_items';
    protected const DESCRIPTION = 'Reorder Sprint Backlog/Taskboard Work Items

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/{team}/_apis/work/iterations/{iterationId}/workitemsorder (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'iteration_id' => ['type' => 'string', 'required' => true, 'description' => 'The id of the iteration'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/iterations/{iterationId}/workitemsorder';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team', 'iterationId' => 'iteration_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

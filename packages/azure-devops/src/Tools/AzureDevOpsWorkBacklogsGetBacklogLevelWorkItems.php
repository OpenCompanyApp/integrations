<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of work items within a backlog level.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/backlogs/{backlogId}/workItems.
 */
class AzureDevOpsWorkBacklogsGetBacklogLevelWorkItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_backlogs_get_backlog_level_work_items';
    protected const DESCRIPTION = 'Get a list of work items within a backlog level

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/backlogs/{backlogId}/workItems (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'backlog_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `backlogId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/backlogs/{backlogId}/workItems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team', 'backlogId' => 'backlog_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update rows on a board.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/work/boards/{board}/rows.
 */
class AzureDevOpsWorkRowsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_rows_update';
    protected const DESCRIPTION = 'Update rows on a board

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/work/boards/{board}/rows (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'List of board rows to update'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'board' => ['type' => 'string', 'required' => true, 'description' => 'Name or ID of the specific board'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/boards/{board}/rows';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'board' => 'board', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

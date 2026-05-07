<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get board user settings for a board id.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/boards/{board}/boardusersettings.
 */
class AzureDevOpsWorkBoardusersettingsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_boardusersettings_get';
    protected const DESCRIPTION = 'Get board user settings for a board id

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/work/boards/{board}/boardusersettings (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'board' => ['type' => 'string', 'required' => true, 'description' => 'Board ID or Name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/boards/{board}/boardusersettings';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'board' => 'board', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

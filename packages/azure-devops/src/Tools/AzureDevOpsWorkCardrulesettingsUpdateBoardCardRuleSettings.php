<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update board card Rule settings for the board id or board by name.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/{team}/_apis/work/boards/{board}/cardrulesettings.
 */
class AzureDevOpsWorkCardrulesettingsUpdateBoardCardRuleSettings extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_work_cardrulesettings_update_board_card_rule_settings';
    protected const DESCRIPTION = 'Update board card Rule settings for the board id or board by name

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/{team}/_apis/work/boards/{board}/cardrulesettings (spec: work/7.2/work.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'board' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `board`.'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/work/boards/{board}/cardrulesettings';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'board' => 'board', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

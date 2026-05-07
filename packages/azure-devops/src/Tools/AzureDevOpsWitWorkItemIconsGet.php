<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a work item icon given the friendly name and icon color..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/wit/workitemicons/{icon}.
 */
class AzureDevOpsWitWorkItemIconsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_work_item_icons_get';
    protected const DESCRIPTION = 'Get a work item icon given the friendly name and icon color.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/wit/workitemicons/{icon} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['icon' => ['type' => 'string', 'required' => true, 'description' => 'The name of the icon'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'color' => ['type' => 'string', 'required' => false, 'description' => 'The 6-digit hex color for the icon'], 'v' => ['type' => 'number', 'required' => false, 'description' => 'The version of the icon (used only for cache invalidation)'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/wit/workitemicons/{icon}';
    protected const PATH_PARAMS = ['icon' => 'icon', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['color' => 'color', 'v' => 'v', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

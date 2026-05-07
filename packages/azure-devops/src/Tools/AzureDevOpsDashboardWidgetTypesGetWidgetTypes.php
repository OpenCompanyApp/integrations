<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all available widget metadata in alphabetical order, including widgets marked with isVisibleFromCatalog == false..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/dashboard/widgettypes.
 */
class AzureDevOpsDashboardWidgetTypesGetWidgetTypes extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_dashboard_widget_types_get_widget_types';
    protected const DESCRIPTION = 'Get all available widget metadata in alphabetical order, including widgets marked with isVisibleFromCatalog == false.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/dashboard/widgettypes (spec: dashboard/7.2/dashboard.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'scope' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$scope`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/dashboard/widgettypes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$scope' => 'scope', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

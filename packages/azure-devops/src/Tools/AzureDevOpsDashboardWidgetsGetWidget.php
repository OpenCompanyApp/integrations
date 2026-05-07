<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the current state of the specified widget..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}/widgets/{widgetId}.
 */
class AzureDevOpsDashboardWidgetsGetWidget extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_dashboard_widgets_get_widget';
    protected const DESCRIPTION = 'Get the current state of the specified widget.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}/widgets/{widgetId} (spec: dashboard/7.2/dashboard.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'dashboard_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the dashboard containing the widget.'], 'widget_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the widget to read.'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}/widgets/{widgetId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'dashboardId' => 'dashboard_id', 'widgetId' => 'widget_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Replace the widgets on specified dashboard with the supplied widgets..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}/widgets.
 */
class AzureDevOpsDashboardWidgetsReplaceWidgets extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_dashboard_widgets_replace_widgets';
    protected const DESCRIPTION = 'Replace the widgets on specified dashboard with the supplied widgets.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}/widgets (spec: dashboard/7.2/dashboard.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Revised state of widgets to store for the dashboard.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'dashboard_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the Dashboard to modify.'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'e_tag' => ['type' => 'string', 'required' => false, 'description' => 'Dashboard Widgets Version'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}/widgets';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'dashboardId' => 'dashboard_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = ['eTag' => 'e_tag'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

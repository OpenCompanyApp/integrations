<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Replace configuration for the specified dashboard. Replaces Widget list on Dashboard, only if property is supplied..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}.
 */
class AzureDevOpsDashboardDashboardsReplaceDashboard extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_dashboard_dashboards_replace_dashboard';
    protected const DESCRIPTION = 'Replace configuration for the specified dashboard. Replaces Widget list on Dashboard, only if property is supplied.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId} (spec: dashboard/7.2/dashboard.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The Configuration of the dashboard to replace.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'dashboard_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the dashboard to replace.'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'dashboardId' => 'dashboard_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

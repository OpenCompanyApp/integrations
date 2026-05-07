<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a dashboard given its ID. This also deletes the widgets associated with this dashboard..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}.
 */
class AzureDevOpsDashboardDashboardsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_dashboard_dashboards_delete';
    protected const DESCRIPTION = 'Delete a dashboard given its ID. This also deletes the widgets associated with this dashboard.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId} (spec: dashboard/7.2/dashboard.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'dashboard_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the dashboard to delete.'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/dashboard/dashboards/{dashboardId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'dashboardId' => 'dashboard_id', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

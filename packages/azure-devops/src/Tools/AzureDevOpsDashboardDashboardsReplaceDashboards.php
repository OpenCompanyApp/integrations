<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the name and position of dashboards in the supplied group, and remove omitted dashboards. Does not modify dashboard content..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards.
 */
class AzureDevOpsDashboardDashboardsReplaceDashboards extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_dashboard_dashboards_replace_dashboards';
    protected const DESCRIPTION = 'Update the name and position of dashboards in the supplied group, and remove omitted dashboards. Does not modify dashboard content.

Official Azure DevOps REST API 7.2 endpoint: PUT https://dev.azure.com/{organization}/{project}/{team}/_apis/dashboard/dashboards (spec: dashboard/7.2/dashboard.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'team' => ['type' => 'string', 'required' => true, 'description' => 'Team ID or team name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PUT';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/{team}/_apis/dashboard/dashboards';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'team' => 'team'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

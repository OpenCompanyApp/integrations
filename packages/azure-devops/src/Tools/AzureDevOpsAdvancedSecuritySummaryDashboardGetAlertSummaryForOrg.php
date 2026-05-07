<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Alert summary by severity for the org.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/_apis/reporting/summary/alerts.
 */
class AzureDevOpsAdvancedSecuritySummaryDashboardGetAlertSummaryForOrg extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_summary_dashboard_get_alert_summary_for_org';
    protected const DESCRIPTION = 'Get Alert summary by severity for the org

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/_apis/reporting/summary/alerts (spec: advancedSecurity/7.2/advancedSecurity.Reporting.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'criteria_alert_types' => ['type' => 'array', 'required' => false, 'description' => 'If provided, only return summary data for alerts of this type. Otherwise, return summary data for alerts of all types.'], 'criteria_keywords' => ['type' => 'string', 'required' => false, 'description' => 'If provided, only return repos whose titles match this pattern.'], 'criteria_period' => ['type' => 'string', 'required' => false, 'description' => 'If provided, summary data will be scoped to this time period.'], 'criteria_projects' => ['type' => 'array', 'required' => false, 'description' => 'If provided, only return summary data for these projects Otherwise, return summary data for all projects.'], 'criteria_severities' => ['type' => 'array', 'required' => false, 'description' => 'If provided, only return summary data for alerts at these severities. <br />Otherwise, return summary data for alerts at any severity.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/reporting/summary/alerts';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['criteria.alertTypes' => 'criteria_alert_types', 'criteria.keywords' => 'criteria_keywords', 'criteria.period' => 'criteria_period', 'criteria.projects' => 'criteria_projects', 'criteria.severities' => 'criteria_severities', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

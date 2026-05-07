<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get Enablement summary for the org.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/_apis/reporting/summary/enablement.
 */
class AzureDevOpsAdvancedSecuritySummaryDashboardGetEnablementSummaryForOrg extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_summary_dashboard_get_enablement_summary_for_org';
    protected const DESCRIPTION = 'Get Enablement summary for the org

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/_apis/reporting/summary/enablement (spec: advancedSecurity/7.2/advancedSecurity.Reporting.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'criteria_keywords' => ['type' => 'string', 'required' => false, 'description' => 'If provided, only return repos whose titles match this pattern.'], 'criteria_projects' => ['type' => 'array', 'required' => false, 'description' => 'If provided, only return summary data for these projects. Otherwise, return summary data for all projects.'], 'criteria_states_any_tool' => ['type' => 'boolean', 'required' => false, 'description' => 'True if any tool is enabled for the repository, false if any tool is disabled.'], 'criteria_states_code_alerts' => ['type' => 'boolean', 'required' => false, 'description' => 'True if code scanning alerts are enabled for the repository, false if disabled.'], 'criteria_states_code_pralerts' => ['type' => 'boolean', 'required' => false, 'description' => 'True if code scanning pull request alerts are enabled for the repository, false if disabled.'], 'criteria_states_dependency_alerts' => ['type' => 'boolean', 'required' => false, 'description' => 'True if dependency alerts are enabled for the repository, false if disabled.'], 'criteria_states_dependency_pralerts' => ['type' => 'boolean', 'required' => false, 'description' => 'True if dependency pull request alerts are enabled for the repository, false if disabled.'], 'criteria_states_push_protection' => ['type' => 'boolean', 'required' => false, 'description' => 'True if pushes containing secrets will be blocked, false if they will not.'], 'criteria_states_secret_alerts' => ['type' => 'boolean', 'required' => false, 'description' => 'True if secret scanning is enabled for the repository, false if disabled.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/reporting/summary/enablement';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['criteria.keywords' => 'criteria_keywords', 'criteria.projects' => 'criteria_projects', 'criteria.states.anyTool' => 'criteria_states_any_tool', 'criteria.states.codeAlerts' => 'criteria_states_code_alerts', 'criteria.states.codePRAlerts' => 'criteria_states_code_pralerts', 'criteria.states.dependencyAlerts' => 'criteria_states_dependency_alerts', 'criteria.states.dependencyPRAlerts' => 'criteria_states_dependency_pralerts', 'criteria.states.pushProtection' => 'criteria_states_push_protection', 'criteria.states.secretAlerts' => 'criteria_states_secret_alerts', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

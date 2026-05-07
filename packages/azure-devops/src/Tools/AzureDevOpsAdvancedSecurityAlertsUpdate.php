<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the status of an alert.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}.
 */
class AzureDevOpsAdvancedSecurityAlertsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_alerts_update';
    protected const DESCRIPTION = 'Update the status of an alert

Official Azure DevOps REST API 7.2 endpoint: PATCH https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId} (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The new status of the alert'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'alert_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the alert'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'alertId' => 'alert_id', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

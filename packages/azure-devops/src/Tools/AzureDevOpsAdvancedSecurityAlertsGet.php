<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get an alert..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}.
 */
class AzureDevOpsAdvancedSecurityAlertsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_alerts_get';
    protected const DESCRIPTION = 'Get an alert.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId} (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'alert_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of alert to retrieve'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'Name or id of a repository that alert is part of'], 'ref' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `ref`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Expand attributes of a secret alert. Possible values are `None` and `ValidationFingerprint`. Defaults to `None`. Be aware that if `expand` is set to `ValidationFingerprint`, the response may contain the secret in its unencrypted form. Please exercise caution when using this data.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/alerts/{alertId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'alertId' => 'alert_id', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['ref' => 'ref', 'expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

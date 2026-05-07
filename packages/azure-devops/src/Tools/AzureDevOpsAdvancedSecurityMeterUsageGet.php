<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get commiters used when calculating billing information..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/_apis/management/meterusage/default.
 */
class AzureDevOpsAdvancedSecurityMeterUsageGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_meter_usage_get';
    protected const DESCRIPTION = 'Get commiters used when calculating billing information.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/_apis/management/meterusage/default (spec: advancedSecurity/7.2/management.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'plan' => ['type' => 'string', 'required' => false, 'description' => 'The plan to query. Plans supported: CodeSecurity and SecretProtection. This is a mandatory parameter.'], 'billing_date' => ['type' => 'string', 'required' => false, 'description' => 'The date to query, or if not provided, today'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/management/meterusage/default';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['plan' => 'plan', 'billingDate' => 'billing_date', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

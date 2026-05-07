<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Estimate the pushers that would be added to the customer's usage if Advanced Security was enabled for this organization..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/_apis/management/meterUsageEstimate/default.
 */
class AzureDevOpsAdvancedSecurityOrgMeterUsageEstimateGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_org_meter_usage_estimate_get';
    protected const DESCRIPTION = 'Estimate the pushers that would be added to the customer\'s usage if Advanced Security was enabled for this organization.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/_apis/management/meterUsageEstimate/default (spec: advancedSecurity/7.2/management.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'plan' => ['type' => 'string', 'required' => false, 'description' => 'The plan to query.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/management/meterUsageEstimate/default';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['plan' => 'plan', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

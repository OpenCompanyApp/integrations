<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Check the availability of symbol service. This includes checking for feature flag, and possibly license in future. Note this is NOT an anonymous endpoint, and the caller will be redirected to authentication before hitting it..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/availability.
 */
class AzureDevOpsSymbolAvailabilityCheckAvailability extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_symbol_availability_check_availability';
    protected const DESCRIPTION = 'Check the availability of symbol service. This includes checking for feature flag, and possibly license in future. Note this is NOT an anonymous endpoint, and the caller will be redirected to authentication before hitting it.

Official Azure DevOps REST API 7.2 endpoint: GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/availability (spec: symbol/7.2/symbol.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'artifacts.dev.azure.com';
    protected const PATH = '/{organization}/_apis/symbol/availability';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

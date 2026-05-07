<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a new advanced filter for the organization..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch.
 */
class AzureDevOpsAdvancedSecurityFiltersSettingsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_filters_settings_create';
    protected const DESCRIPTION = 'Creates a new advanced filter for the organization.

Official Azure DevOps REST API 7.2 endpoint: POST https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch (spec: advancedSecurity/7.2/advancedSecurity.Reporting.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The advanced filter to create.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/reporting/filtersSettings/alertsbatch';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

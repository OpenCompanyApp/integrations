<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a specific advanced filter by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch/{filterId}.
 */
class AzureDevOpsAdvancedSecurityFiltersSettingsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_filters_settings_get';
    protected const DESCRIPTION = 'Gets a specific advanced filter by its ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch/{filterId} (spec: advancedSecurity/7.2/advancedSecurity.Reporting.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'filter_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the advanced filter to retrieve.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/reporting/filtersSettings/alertsbatch/{filterId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'filterId' => 'filter_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

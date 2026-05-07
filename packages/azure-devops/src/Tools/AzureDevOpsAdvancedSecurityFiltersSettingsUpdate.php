<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Updates an advanced filter. Only the name can be updated..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch/{filterId}.
 */
class AzureDevOpsAdvancedSecurityFiltersSettingsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_filters_settings_update';
    protected const DESCRIPTION = 'Updates an advanced filter. Only the name can be updated.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch/{filterId} (spec: advancedSecurity/7.2/advancedSecurity.Reporting.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The update data containing the new name.'], 'filter_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the advanced filter to update.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/reporting/filtersSettings/alertsbatch/{filterId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'filterId' => 'filter_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

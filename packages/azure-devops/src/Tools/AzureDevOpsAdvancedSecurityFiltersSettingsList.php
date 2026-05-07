<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets all advanced filters for the organization..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch.
 */
class AzureDevOpsAdvancedSecurityFiltersSettingsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_filters_settings_list';
    protected const DESCRIPTION = 'Gets all advanced filters for the organization.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/_apis/reporting/filtersSettings/alertsbatch (spec: advancedSecurity/7.2/advancedSecurity.Reporting.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to include soft-deleted filters.'], 'keywords' => ['type' => 'string', 'required' => false, 'description' => 'Optional filter to search filters by name (case-insensitive, partial match).'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/_apis/reporting/filtersSettings/alertsbatch';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['includeDeleted' => 'include_deleted', 'keywords' => 'keywords', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

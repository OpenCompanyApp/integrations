<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * List the installed extensions in the account / project collection..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensions.
 */
class AzureDevOpsExtensionManagementInstalledExtensionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_extension_management_installed_extensions_list';
    protected const DESCRIPTION = 'List the installed extensions in the account / project collection.

Official Azure DevOps REST API 7.2 endpoint: GET https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensions (spec: extensionManagement/7.2/extensionManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'include_disabled_extensions' => ['type' => 'boolean', 'required' => false, 'description' => 'If true (the default), include disabled extensions in the results.'], 'include_errors' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, include installed extensions with errors.'], 'asset_types' => ['type' => 'string', 'required' => false, 'description' => 'Determines which files are returned in the files array. Provide the wildcard \'*\' to return all files, or a colon separated list to retrieve files with specific asset types.'], 'include_installation_issues' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `includeInstallationIssues`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'extmgmt.dev.azure.com';
    protected const PATH = '/{organization}/_apis/extensionmanagement/installedextensions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['includeDisabledExtensions' => 'include_disabled_extensions', 'includeErrors' => 'include_errors', 'assetTypes' => 'asset_types', 'includeInstallationIssues' => 'include_installation_issues', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

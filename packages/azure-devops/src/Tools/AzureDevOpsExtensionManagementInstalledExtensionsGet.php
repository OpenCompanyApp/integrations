<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get an installed extension by its publisher and extension name..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}.
 */
class AzureDevOpsExtensionManagementInstalledExtensionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_extension_management_installed_extensions_get';
    protected const DESCRIPTION = 'Get an installed extension by its publisher and extension name.

Official Azure DevOps REST API 7.2 endpoint: GET https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName} (spec: extensionManagement/7.2/extensionManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the publisher. Example: "fabrikam".'], 'extension_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the extension. Example: "ops-tools".'], 'asset_types' => ['type' => 'string', 'required' => false, 'description' => 'Determines which files are returned in the files array. Provide the wildcard \'*\' to return all files, or a colon separated list to retrieve files with specific asset types.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'extmgmt.dev.azure.com';
    protected const PATH = '/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'publisherName' => 'publisher_name', 'extensionName' => 'extension_name'];
    protected const QUERY_PARAMS = ['assetTypes' => 'asset_types', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Uninstall the specified extension from the account / project collection..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}.
 */
class AzureDevOpsExtensionManagementInstalledExtensionsUninstallExtensionByName extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_extension_management_installed_extensions_uninstall_extension_by_name';
    protected const DESCRIPTION = 'Uninstall the specified extension from the account / project collection.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName} (spec: extensionManagement/7.2/extensionManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the publisher. Example: "fabrikam".'], 'extension_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the extension. Example: "ops-tools".'], 'reason' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `reason`.'], 'reason_code' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `reasonCode`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'extmgmt.dev.azure.com';
    protected const PATH = '/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'publisherName' => 'publisher_name', 'extensionName' => 'extension_name'];
    protected const QUERY_PARAMS = ['reason' => 'reason', 'reasonCode' => 'reason_code', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

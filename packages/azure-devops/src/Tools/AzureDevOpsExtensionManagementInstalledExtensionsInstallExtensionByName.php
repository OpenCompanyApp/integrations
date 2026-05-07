<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Install the specified extension into the account / project collection..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}/{version}.
 */
class AzureDevOpsExtensionManagementInstalledExtensionsInstallExtensionByName extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_extension_management_installed_extensions_install_extension_by_name';
    protected const DESCRIPTION = 'Install the specified extension into the account / project collection.

Official Azure DevOps REST API 7.2 endpoint: POST https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}/{version} (spec: extensionManagement/7.2/extensionManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'publisher_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the publisher. Example: "fabrikam".'], 'extension_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the extension. Example: "ops-tools".'], 'version' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `version`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'extmgmt.dev.azure.com';
    protected const PATH = '/{organization}/_apis/extensionmanagement/installedextensionsbyname/{publisherName}/{extensionName}/{version}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'publisherName' => 'publisher_name', 'extensionName' => 'extension_name', 'version' => 'version'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update an installed extension. Typically this API is used to enable or disable an extension..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensions.
 */
class AzureDevOpsExtensionManagementInstalledExtensionsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_extension_management_installed_extensions_update';
    protected const DESCRIPTION = 'Update an installed extension. Typically this API is used to enable or disable an extension.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://extmgmt.dev.azure.com/{organization}/_apis/extensionmanagement/installedextensions (spec: extensionManagement/7.2/extensionManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'extmgmt.dev.azure.com';
    protected const PATH = '/{organization}/_apis/extensionmanagement/installedextensions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

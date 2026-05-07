<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get all service-wide feed creation and administration permissions..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://feeds.dev.azure.com/{organization}/_apis/packaging/globalpermissions.
 */
class AzureDevOpsArtifactsServiceSettingsGetGlobalPermissions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_service_settings_get_global_permissions';
    protected const DESCRIPTION = 'Get all service-wide feed creation and administration permissions.

Official Azure DevOps REST API 7.2 endpoint: GET https://feeds.dev.azure.com/{organization}/_apis/packaging/globalpermissions (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'include_ids' => ['type' => 'boolean', 'required' => false, 'description' => 'Set to true to add IdentityIds to the permission objects.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/_apis/packaging/globalpermissions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['includeIds' => 'include_ids', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

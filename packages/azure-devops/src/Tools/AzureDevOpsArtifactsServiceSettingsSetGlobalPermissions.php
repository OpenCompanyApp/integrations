<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Set service-wide permissions that govern feed creation and administration..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://feeds.dev.azure.com/{organization}/_apis/packaging/globalpermissions.
 */
class AzureDevOpsArtifactsServiceSettingsSetGlobalPermissions extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_artifacts_service_settings_set_global_permissions';
    protected const DESCRIPTION = 'Set service-wide permissions that govern feed creation and administration.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://feeds.dev.azure.com/{organization}/_apis/packaging/globalpermissions (spec: artifacts/7.2/feed.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'New permissions for the organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'feeds.dev.azure.com';
    protected const PATH = '/{organization}/_apis/packaging/globalpermissions';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

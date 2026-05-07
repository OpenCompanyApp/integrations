<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets an operation from the operationId using the given pluginId. Some scenarios don’t require a pluginId. If a pluginId is not included in the call then just the operationId will be used to find an operation..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/_apis/operations/{operationId}.
 */
class AzureDevOpsOperationsOperationsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_operations_operations_get';
    protected const DESCRIPTION = 'Gets an operation from the operationId using the given pluginId. Some scenarios don’t require a pluginId. If a pluginId is not included in the call then just the operationId will be used to find an operation.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/_apis/operations/{operationId} (spec: operations/7.2/operations.json).';
    protected const PARAMETERS = ['operation_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID for the operation.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'plugin_id' => ['type' => 'string', 'required' => false, 'description' => 'The ID for the plugin.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/_apis/operations/{operationId}';
    protected const PATH_PARAMS = ['operationId' => 'operation_id', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['pluginId' => 'plugin_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

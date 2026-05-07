<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a symbol request by request identifier..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/requests/{requestId}.
 */
class AzureDevOpsSymbolRequestsGetRequestsRequestId extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_symbol_requests_get_requests_request_id';
    protected const DESCRIPTION = 'Get a symbol request by request identifier.

Official Azure DevOps REST API 7.2 endpoint: GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/requests/{requestId} (spec: symbol/7.2/symbol.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'request_id' => ['type' => 'string', 'required' => true, 'description' => 'The symbol request identifier.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'artifacts.dev.azure.com';
    protected const PATH = '/{organization}/_apis/symbol/requests/{requestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'requestId' => 'request_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

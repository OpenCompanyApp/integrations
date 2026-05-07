<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a symbol request by request name..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://artifacts.dev.azure.com/{organization}/_apis/symbol/requests.
 */
class AzureDevOpsSymbolRequestsUpdateRequestsRequestName extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_symbol_requests_update_requests_request_name';
    protected const DESCRIPTION = 'Update a symbol request by request name.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://artifacts.dev.azure.com/{organization}/_apis/symbol/requests (spec: symbol/7.2/symbol.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The symbol request.'], 'request_name' => ['type' => 'string', 'required' => false, 'description' => 'The symbol request name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'artifacts.dev.azure.com';
    protected const PATH = '/{organization}/_apis/symbol/requests';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['requestName' => 'request_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

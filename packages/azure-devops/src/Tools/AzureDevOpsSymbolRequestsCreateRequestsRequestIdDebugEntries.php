<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create debug entries for a symbol request as specified by its identifier..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://artifacts.dev.azure.com/{organization}/_apis/symbol/requests/{requestId}.
 */
class AzureDevOpsSymbolRequestsCreateRequestsRequestIdDebugEntries extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_symbol_requests_create_requests_request_id_debug_entries';
    protected const DESCRIPTION = 'Create debug entries for a symbol request as specified by its identifier.

Official Azure DevOps REST API 7.2 endpoint: POST https://artifacts.dev.azure.com/{organization}/_apis/symbol/requests/{requestId} (spec: symbol/7.2/symbol.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A batch that contains debug entries to create.'], 'request_id' => ['type' => 'string', 'required' => true, 'description' => 'The symbol request identifier.'], 'collection' => ['type' => 'string', 'required' => false, 'description' => 'A valid debug entry collection name. Must be "debugentries".'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'artifacts.dev.azure.com';
    protected const PATH = '/{organization}/_apis/symbol/requests/{requestId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'requestId' => 'request_id'];
    protected const QUERY_PARAMS = ['collection' => 'collection', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

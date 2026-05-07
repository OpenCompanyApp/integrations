<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Given a client key, returns the best matched debug entry..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/symsrv/{debugEntryClientKey}.
 */
class AzureDevOpsSymbolSymsrvGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_symbol_symsrv_get';
    protected const DESCRIPTION = 'Given a client key, returns the best matched debug entry.

Official Azure DevOps REST API 7.2 endpoint: GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/symsrv/{debugEntryClientKey} (spec: symbol/7.2/symbol.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'debug_entry_client_key' => ['type' => 'string', 'required' => true, 'description' => 'A "client key" used by both ends of Microsoft\'s symbol protocol to identify a debug entry. The semantics of client key is governed by symsrv and is beyond the scope of this documentation.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'artifacts.dev.azure.com';
    protected const PATH = '/{organization}/_apis/symbol/symsrv/{debugEntryClientKey}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'debugEntryClientKey' => 'debug_entry_client_key'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

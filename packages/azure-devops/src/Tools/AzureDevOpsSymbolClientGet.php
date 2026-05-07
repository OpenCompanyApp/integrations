<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get the client package..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/client/{clientType}.
 */
class AzureDevOpsSymbolClientGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_symbol_client_get';
    protected const DESCRIPTION = 'Get the client package.

Official Azure DevOps REST API 7.2 endpoint: GET https://artifacts.dev.azure.com/{organization}/_apis/symbol/client/{clientType} (spec: symbol/7.2/symbol.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'client_type' => ['type' => 'string', 'required' => true, 'description' => 'Either "EXE" for a zip file containing a Windows symbol client (a.k.a. symbol.exe) along with dependencies, or "TASK" for a VSTS task that can be run on a VSTS build agent. All the other values are invalid. The parameter is case-insensitive.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'artifacts.dev.azure.com';
    protected const PATH = '/{organization}/_apis/symbol/client/{clientType}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'clientType' => 'client_type'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

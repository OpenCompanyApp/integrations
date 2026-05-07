<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Resolve a storage key to a descriptor.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/descriptors/{storageKey}.
 */
class AzureDevOpsGraphDescriptorsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_descriptors_get';
    protected const DESCRIPTION = 'Resolve a storage key to a descriptor

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/descriptors/{storageKey} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['storage_key' => ['type' => 'string', 'required' => true, 'description' => 'Storage key of the subject (user, group, scope, etc.) to resolve'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/descriptors/{storageKey}';
    protected const PATH_PARAMS = ['storageKey' => 'storage_key', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/graph/Users/{userDescriptor}/providerinfo.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/Users/{userDescriptor}/providerinfo.
 */
class AzureDevOpsGraphProviderInfoGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_provider_info_get';
    protected const DESCRIPTION = 'GET /{organization}/_apis/graph/Users/{userDescriptor}/providerinfo

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/Users/{userDescriptor}/providerinfo (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['user_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `userDescriptor`.'], 'organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/Users/{userDescriptor}/providerinfo';
    protected const PATH_PARAMS = ['userDescriptor' => 'user_descriptor', 'organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a user by its descriptor..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/users/{userDescriptor}.
 */
class AzureDevOpsGraphUsersGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_users_get';
    protected const DESCRIPTION = 'Get a user by its descriptor.

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/users/{userDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'user_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the desired user.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/users/{userDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'userDescriptor' => 'user_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

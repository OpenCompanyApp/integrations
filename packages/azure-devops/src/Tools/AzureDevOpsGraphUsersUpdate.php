<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Map an existing user to a different user. The body of the request must be a derived type of GraphUserUpdateContext: * GraphUserOriginIdUpdateContext - Map an existing user in an account, to an existing user from an external AD or AAD backed provider using the OriginId as a reference..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vssps.dev.azure.com/{organization}/_apis/graph/users/{userDescriptor}.
 */
class AzureDevOpsGraphUsersUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_users_update';
    protected const DESCRIPTION = 'Map an existing user to a different user. The body of the request must be a derived type of GraphUserUpdateContext: * GraphUserOriginIdUpdateContext - Map an existing user in an account, to an existing user from an external AD or AAD backed provider using the OriginId as a reference.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vssps.dev.azure.com/{organization}/_apis/graph/users/{userDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The subset of the full graph user used to uniquely find the graph subject in an external provider.'], 'user_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the user to update'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/users/{userDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'userDescriptor' => 'user_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

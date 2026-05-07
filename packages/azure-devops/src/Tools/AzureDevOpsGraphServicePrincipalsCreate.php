<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Materialize an existing AAD service principal into the ADO account. NOTE: Created service principals are not active in an account. Adding a service principal to an account is required before the service principal can be added to ADO groups or assigned an asset. The body of the request must be a derived type of GraphServicePrincipalCreationContext: * GraphServicePrincipalOriginIdCreationContext - Create a new service principal using the OriginID as a reference to an existing service principal from AAD backed provider. If the service principal to be added corresponds to a service principal that was previously deleted, then that service principal will be restored. Optionally, you can add the newly created service principal as a member of an existing ADO group and/or specify a custom storage key for the service principal..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/graph/serviceprincipals.
 */
class AzureDevOpsGraphServicePrincipalsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_service_principals_create';
    protected const DESCRIPTION = 'Materialize an existing AAD service principal into the ADO account. NOTE: Created service principals are not active in an account. Adding a service principal to an account is required before the service principal can be added to ADO groups or assigned an asset. The body of the request must be a derived type of GraphServicePrincipalCreationContext: * GraphServicePrincipalOriginIdCreationContext - Create a new service principal using the OriginID as a reference to an existing service principal from AAD backed provider. If the service principal to be added corresponds to a service principal that was previously deleted, then that service principal will be restored. Optionally, you can add the newly created service principal as a member of an existing ADO group and/or specify a custom storage key for the service principal.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/graph/serviceprincipals (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The subset of the full graph service principal used to uniquely find the graph subject in an external provider.'], 'group_descriptors' => ['type' => 'string', 'required' => false, 'description' => 'A comma separated list of descriptors of groups you want the graph service principal to join'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/serviceprincipals';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['groupDescriptors' => 'group_descriptors', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Materialize an existing AAD or MSA user into the ADO account. NOTE: Created users are not active in an account unless they have been explicitly assigned a parent group at creation time or have signed in and been autolicensed through AAD group memberships. Adding a user to an account is required before the user can be added to ADO groups or assigned an asset. The body of the request must be a derived type of GraphUserCreationContext: * GraphUserMailAddressCreationContext - Create a new user using the mail address as a reference to an existing user from an external AD or AAD backed provider. * GraphUserOriginIdCreationContext - Create a new user using the OriginID as a reference to an existing user from an external AD or AAD backed provider. * GraphUserPrincipalNameCreationContext - Create a new user using the principal name as a reference to an existing user from an external AD or AAD backed provider. If the user to be added corresponds to a user that was previously deleted, then that user will be restored. Optionally, you can add the newly created user as a member of an existing ADO group and/or specify a custom storage key for the user..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/graph/users.
 */
class AzureDevOpsGraphUsersCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_users_create';
    protected const DESCRIPTION = 'Materialize an existing AAD or MSA user into the ADO account. NOTE: Created users are not active in an account unless they have been explicitly assigned a parent group at creation time or have signed in and been autolicensed through AAD group memberships. Adding a user to an account is required before the user can be added to ADO groups or assigned an asset. The body of the request must be a derived type of GraphUserCreationContext: * GraphUserMailAddressCreationContext - Create a new user using the mail address as a reference to an existing user from an external AD or AAD backed provider. * GraphUserOriginIdCreationContext - Create a new user using the OriginID as a reference to an existing user from an external AD or AAD backed provider. * GraphUserPrincipalNameCreationContext - Create a new user using the principal name as a reference to an existing user from an external AD or AAD backed provider. If the user to be added corresponds to a user that was previously deleted, then that user will be restored. Optionally, you can add the newly created user as a member of an existing ADO group and/or specify a custom storage key for the user.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/graph/users (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The subset of the full graph user used to uniquely find the graph subject in an external provider.'], 'group_descriptors' => ['type' => 'string', 'required' => false, 'description' => 'A comma separated list of descriptors of groups you want the graph user to join'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/users';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['groupDescriptors' => 'group_descriptors', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

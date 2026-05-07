<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create a new Azure DevOps group or materialize an existing AAD group. The body of the request must be a derived type of GraphGroupCreationContext: * GraphGroupVstsCreationContext - Create a new Azure DevOps group that is not backed by an external provider. * GraphGroupMailAddressCreationContext - Create a new group using the mail address as a reference to an existing group from an external AD or AAD backed provider. * GraphGroupOriginIdCreationContext - Create a new group using the OriginID as a reference to a group from an external AD or AAD backed provider. Optionally, you can add the newly created group as a member of an existing Azure DevOps group and/or specify a custom storage key for the group..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/graph/groups.
 */
class AzureDevOpsGraphGroupsCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_groups_create';
    protected const DESCRIPTION = 'Create a new Azure DevOps group or materialize an existing AAD group. The body of the request must be a derived type of GraphGroupCreationContext: * GraphGroupVstsCreationContext - Create a new Azure DevOps group that is not backed by an external provider. * GraphGroupMailAddressCreationContext - Create a new group using the mail address as a reference to an existing group from an external AD or AAD backed provider. * GraphGroupOriginIdCreationContext - Create a new group using the OriginID as a reference to a group from an external AD or AAD backed provider. Optionally, you can add the newly created group as a member of an existing Azure DevOps group and/or specify a custom storage key for the group.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/graph/groups (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The subset of the full graph group used to uniquely find the graph subject in an external provider.'], 'scope_descriptor' => ['type' => 'string', 'required' => false, 'description' => 'A descriptor referencing the scope (collection, project) in which the group should be created. If omitted, will be created in the scope of the enclosing account or organization. Valid only for VSTS groups.'], 'group_descriptors' => ['type' => 'string', 'required' => false, 'description' => 'A comma separated list of descriptors referencing groups you want the graph group to join'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/groups';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['scopeDescriptor' => 'scope_descriptor', 'groupDescriptors' => 'group_descriptors', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update the properties of an Azure DevOps group. Currently limited to only changing the description and account name..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vssps.dev.azure.com/{organization}/_apis/graph/groups/{groupDescriptor}.
 */
class AzureDevOpsGraphGroupsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_groups_update';
    protected const DESCRIPTION = 'Update the properties of an Azure DevOps group. Currently limited to only changing the description and account name.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vssps.dev.azure.com/{organization}/_apis/graph/groups/{groupDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the group to modify.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The JSON+Patch document containing the fields to alter.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/groups/{groupDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupDescriptor' => 'group_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes an Azure DevOps group from all of its parent groups. The group will still be visible, but membership checks for the group, and all descendants which derive membership through it, will return false.”.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vssps.dev.azure.com/{organization}/_apis/graph/groups/{groupDescriptor}.
 */
class AzureDevOpsGraphGroupsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_groups_delete';
    protected const DESCRIPTION = 'Removes an Azure DevOps group from all of its parent groups. The group will still be visible, but membership checks for the group, and all descendants which derive membership through it, will return false.”

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vssps.dev.azure.com/{organization}/_apis/graph/groups/{groupDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the group to delete.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/groups/{groupDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupDescriptor' => 'group_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

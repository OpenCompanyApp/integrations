<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a group by its descriptor. The group will be returned even if it has been deleted from the account or has had all its memberships deleted..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/groups/{groupDescriptor}.
 */
class AzureDevOpsGraphGroupsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_groups_get';
    protected const DESCRIPTION = 'Get a group by its descriptor. The group will be returned even if it has been deleted from the account or has had all its memberships deleted.

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/groups/{groupDescriptor} (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'group_descriptor' => ['type' => 'string', 'required' => true, 'description' => 'The descriptor of the desired graph group.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/groups/{groupDescriptor}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'groupDescriptor' => 'group_descriptor'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

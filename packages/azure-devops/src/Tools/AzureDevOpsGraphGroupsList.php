<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a list of all groups in the current scope (usually organization or account). The optional parameters are used to filter down the returned results. Returned results are in no guaranteed order. Since the list of groups may be large, results are returned in pages of groups. If there are more results than can be returned in a single page, the result set will contain a continuation token for retrieval of the next set of results..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/groups.
 */
class AzureDevOpsGraphGroupsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_groups_list';
    protected const DESCRIPTION = 'Gets a list of all groups in the current scope (usually organization or account). The optional parameters are used to filter down the returned results. Returned results are in no guaranteed order. Since the list of groups may be large, results are returned in pages of groups. If there are more results than can be returned in a single page, the result set will contain a continuation token for retrieval of the next set of results.

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/groups (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'scope_descriptor' => ['type' => 'string', 'required' => false, 'description' => 'Specify a non-default scope (collection, project) to search for groups.'], 'subject_types' => ['type' => 'string', 'required' => false, 'description' => 'A comma separated list of user subject subtypes to reduce the retrieved results, e.g. Microsoft.IdentityModel.Claims.ClaimsIdentity'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'An opaque data blob that allows the next page of data to resume immediately after where the previous page ended. The only reliable way to know if there is more data left is the presence of a continuation token.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/groups';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['scopeDescriptor' => 'scope_descriptor', 'subjectTypes' => 'subject_types', 'continuationToken' => 'continuation_token', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of all users in a given scope. Since the list of users may be large, results are returned in pages of users. If there are more results than can be returned in a single page, the result set will contain a continuation token for retrieval of the next set of results..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vssps.dev.azure.com/{organization}/_apis/graph/users.
 */
class AzureDevOpsGraphUsersList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_users_list';
    protected const DESCRIPTION = 'Get a list of all users in a given scope. Since the list of users may be large, results are returned in pages of users. If there are more results than can be returned in a single page, the result set will contain a continuation token for retrieval of the next set of results.

Official Azure DevOps REST API 7.2 endpoint: GET https://vssps.dev.azure.com/{organization}/_apis/graph/users (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'subject_types' => ['type' => 'string', 'required' => false, 'description' => 'A comma separated list of user subject subtypes to reduce the retrieved results, e.g. msa’, ‘aad’, ‘svc’ (service identity), ‘imp’ (imported identity), etc.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'An opaque data blob that allows the next page of data to resume immediately after where the previous page ended. The only reliable way to know if there is more data left is the presence of a continuation token.'], 'scope_descriptor' => ['type' => 'string', 'required' => false, 'description' => 'Specify a non-default scope (collection, project) to search for users.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/users';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['subjectTypes' => 'subject_types', 'continuationToken' => 'continuation_token', 'scopeDescriptor' => 'scope_descriptor', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

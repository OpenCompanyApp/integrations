<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Search for Azure Devops users, or/and groups. Results will be returned in a batch with no more than 100 graph subjects..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vssps.dev.azure.com/{organization}/_apis/graph/subjectquery.
 */
class AzureDevOpsGraphSubjectQueryQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_graph_subject_query_query';
    protected const DESCRIPTION = 'Search for Azure Devops users, or/and groups. Results will be returned in a batch with no more than 100 graph subjects.

Official Azure DevOps REST API 7.2 endpoint: POST https://vssps.dev.azure.com/{organization}/_apis/graph/subjectquery (spec: graph/7.2/graph.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The query that we\'ll be using to search includes the following: Query: the search term. The search will be prefix matching only. SubjectKind: "User" or "Group" can be specified, both or either ScopeDescriptor: Non-default scope can be specified, i.e. project scope descriptor'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vssps.dev.azure.com';
    protected const PATH = '/{organization}/_apis/graph/subjectquery';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

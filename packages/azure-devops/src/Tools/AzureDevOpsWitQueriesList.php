<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the root queries and their children.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/queries.
 */
class AzureDevOpsWitQueriesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_queries_list';
    protected const DESCRIPTION = 'Gets the root queries and their children

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/queries (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include the query string (wiql), clauses, query result columns, and sort options in the results.'], 'depth' => ['type' => 'number', 'required' => false, 'description' => 'In the folder of queries, return child queries and folders to this depth.'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Include deleted queries and folders'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/queries';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', '$depth' => 'depth', '$includeDeleted' => 'include_deleted', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

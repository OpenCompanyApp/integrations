<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieves an individual query and its children.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/queries/{query}.
 */
class AzureDevOpsWitQueriesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_queries_get';
    protected const DESCRIPTION = 'Retrieves an individual query and its children

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/queries/{query} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'query' => ['type' => 'string', 'required' => true, 'description' => 'ID or path of the query.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include the query string (wiql), clauses, query result columns, and sort options in the results.'], 'depth' => ['type' => 'number', 'required' => false, 'description' => 'In the folder of queries, return child queries and folders to this depth.'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Include deleted queries and folders'], 'use_iso_date_format' => ['type' => 'boolean', 'required' => false, 'description' => 'DateTime query clauses will be formatted using a ISO 8601 compliant format'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/queries/{query}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'query' => 'query'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', '$depth' => 'depth', '$includeDeleted' => 'include_deleted', '$useIsoDateFormat' => 'use_iso_date_format', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

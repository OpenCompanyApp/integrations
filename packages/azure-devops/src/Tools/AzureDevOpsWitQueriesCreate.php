<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Creates a query, or moves a query. Learn more about Work Item Query Language (WIQL) syntax [here](https://docs.microsoft.com/en-us/vsts/collaborate/wiql-syntax?toc=/vsts/work/track/toc.json&bc=/vsts/work/track/breadcrumb/toc.json&view=vsts)..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wit/queries/{query}.
 */
class AzureDevOpsWitQueriesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_queries_create';
    protected const DESCRIPTION = 'Creates a query, or moves a query. Learn more about Work Item Query Language (WIQL) syntax [here](https://docs.microsoft.com/en-us/vsts/collaborate/wiql-syntax?toc=/vsts/work/track/toc.json&bc=/vsts/work/track/breadcrumb/toc.json&view=vsts).

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wit/queries/{query} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The query to create.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'query' => ['type' => 'string', 'required' => true, 'description' => 'The parent id or path under which the query is to be created.'], 'validate_wiql_only' => ['type' => 'boolean', 'required' => false, 'description' => 'If you only want to validate your WIQL query without actually creating one, set it to true. Default is false.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/queries/{query}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'query' => 'query'];
    protected const QUERY_PARAMS = ['validateWiqlOnly' => 'validate_wiql_only', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

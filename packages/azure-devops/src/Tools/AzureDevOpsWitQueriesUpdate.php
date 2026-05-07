<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update a query or a folder. This allows you to update, rename and move queries and folders..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/wit/queries/{query}.
 */
class AzureDevOpsWitQueriesUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_queries_update';
    protected const DESCRIPTION = 'Update a query or a folder. This allows you to update, rename and move queries and folders.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/wit/queries/{query} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The query to update.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'query' => ['type' => 'string', 'required' => true, 'description' => 'The ID or path for the query to update.'], 'undelete_descendants' => ['type' => 'boolean', 'required' => false, 'description' => 'Undelete the children of this folder. It is important to note that this will not bring back the permission changes that were previously applied to the descendants.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/queries/{query}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'query' => 'query'];
    protected const QUERY_PARAMS = ['$undeleteDescendants' => 'undelete_descendants', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

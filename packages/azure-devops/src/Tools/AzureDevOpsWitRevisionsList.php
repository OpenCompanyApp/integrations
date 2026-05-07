<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns the list of fully hydrated work item revisions, paged..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{id}/revisions.
 */
class AzureDevOpsWitRevisionsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_revisions_list';
    protected const DESCRIPTION = 'Returns the list of fully hydrated work item revisions, paged.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{id}/revisions (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `id`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$expand`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{id}/revisions';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

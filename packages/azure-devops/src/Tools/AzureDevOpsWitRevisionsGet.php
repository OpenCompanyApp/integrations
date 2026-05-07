<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a fully hydrated work item for the requested revision.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{id}/revisions/{revisionNumber}.
 */
class AzureDevOpsWitRevisionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_revisions_get';
    protected const DESCRIPTION = 'Returns a fully hydrated work item for the requested revision

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{id}/revisions/{revisionNumber} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `id`.'], 'revision_number' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `revisionNumber`.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$expand`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{id}/revisions/{revisionNumber}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'id' => 'id', 'revisionNumber' => 'revision_number', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

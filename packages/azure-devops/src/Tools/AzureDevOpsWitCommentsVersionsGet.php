<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/versions/{version}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/versions/{version}.
 */
class AzureDevOpsWitCommentsVersionsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_comments_versions_get';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/versions/{version}

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/versions/{version} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'work_item_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `workItemId`.'], 'comment_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `commentId`.'], 'version' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `version`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/versions/{version}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'workItemId' => 'work_item_id', 'commentId' => 'comment_id', 'version' => 'version'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Delete a comment on a work item..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}.
 */
class AzureDevOpsWitCommentsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_comments_delete';
    protected const DESCRIPTION = 'Delete a comment on a work item.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId} (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'work_item_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of a work item.'], 'comment_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `commentId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'workItemId' => 'work_item_id', 'commentId' => 'comment_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

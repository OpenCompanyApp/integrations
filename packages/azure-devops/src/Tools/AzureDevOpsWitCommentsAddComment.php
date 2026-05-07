<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add a comment on a work item..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments.
 */
class AzureDevOpsWitCommentsAddComment extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_comments_add_comment';
    protected const DESCRIPTION = 'Add a comment on a work item.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Comment create request.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'work_item_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of a work item.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'workItemId' => 'work_item_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

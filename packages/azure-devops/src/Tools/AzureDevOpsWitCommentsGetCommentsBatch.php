<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns a list of work item comments by ids..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments.
 */
class AzureDevOpsWitCommentsGetCommentsBatch extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_comments_get_comments_batch';
    protected const DESCRIPTION = 'Returns a list of work item comments by ids.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'work_item_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of a work item to get comments for.'], 'ids' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated list of comment ids to return.'], 'include_deleted' => ['type' => 'boolean', 'required' => false, 'description' => 'Specify if the deleted comments should be retrieved.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Specifies the additional data retrieval options for work item comments.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'workItemId' => 'work_item_id'];
    protected const QUERY_PARAMS = ['ids' => 'ids', 'includeDeleted' => 'include_deleted', '$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

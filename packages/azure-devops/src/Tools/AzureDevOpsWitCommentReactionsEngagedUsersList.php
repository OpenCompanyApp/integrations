<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get users who reacted on the comment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/reactions/{reactionType}/users.
 */
class AzureDevOpsWitCommentReactionsEngagedUsersList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_wit_comment_reactions_engaged_users_list';
    protected const DESCRIPTION = 'Get users who reacted on the comment.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/reactions/{reactionType}/users (spec: wit/7.2/workItemTracking.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'work_item_id' => ['type' => 'number', 'required' => true, 'description' => 'WorkItem ID.'], 'comment_id' => ['type' => 'number', 'required' => true, 'description' => 'Comment ID.'], 'reaction_type' => ['type' => 'string', 'required' => true, 'description' => 'Type of the reaction.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/wit/workItems/{workItemId}/comments/{commentId}/reactions/{reactionType}/users';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'workItemId' => 'work_item_id', 'commentId' => 'comment_id', 'reactionType' => 'reaction_type'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

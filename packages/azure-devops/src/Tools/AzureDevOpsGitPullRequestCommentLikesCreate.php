<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Add a like on a comment..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/threads/{threadId}/comments/{commentId}/likes.
 */
class AzureDevOpsGitPullRequestCommentLikesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_comment_likes_create';
    protected const DESCRIPTION = 'Add a like on a comment.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/threads/{threadId}/comments/{commentId}/likes (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request\'s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'thread_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the thread that contains the comment.'], 'comment_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the comment.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/threads/{threadId}/comments/{commentId}/likes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'threadId' => 'thread_id', 'commentId' => 'comment_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

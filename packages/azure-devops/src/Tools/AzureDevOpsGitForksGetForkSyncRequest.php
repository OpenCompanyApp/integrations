<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific fork sync operation's details..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests/{forkSyncOperationId}.
 */
class AzureDevOpsGitForksGetForkSyncRequest extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_forks_get_fork_sync_request';
    protected const DESCRIPTION = 'Get a specific fork sync operation\'s details.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests/{forkSyncOperationId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_name_or_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'fork_sync_operation_id' => ['type' => 'number', 'required' => true, 'description' => 'OperationId of the sync request.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include links.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests/{forkSyncOperationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryNameOrId' => 'repository_name_or_id', 'forkSyncOperationId' => 'fork_sync_operation_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

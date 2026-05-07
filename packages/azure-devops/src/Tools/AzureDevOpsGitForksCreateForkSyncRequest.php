<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Request that another repository's refs be fetched into this one. It syncs two existing forks. To create a fork, please see the <a href="https://docs.microsoft.com/en-us/rest/api/vsts/git/repositories/create?view=azure-devops-rest-5.1"> repositories endpoint</a>.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests.
 */
class AzureDevOpsGitForksCreateForkSyncRequest extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_forks_create_fork_sync_request';
    protected const DESCRIPTION = 'Request that another repository\'s refs be fetched into this one. It syncs two existing forks. To create a fork, please see the <a href="https://docs.microsoft.com/en-us/rest/api/vsts/git/repositories/create?view=azure-devops-rest-5.1"> repositories endpoint</a>

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Source repository and ref mapping.'], 'repository_name_or_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include links'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/forkSyncRequests';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryNameOrId' => 'repository_name_or_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

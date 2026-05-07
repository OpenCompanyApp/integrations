<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieves a particular push..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pushes/{pushId}.
 */
class AzureDevOpsGitPushesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pushes_get';
    protected const DESCRIPTION = 'Retrieves a particular push.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pushes/{pushId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'push_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the push.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'include_commits' => ['type' => 'number', 'required' => false, 'description' => 'The number of commits to include in the result.'], 'include_ref_updates' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, include the list of refs that were updated by the push.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pushes/{pushId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pushId' => 'push_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['includeCommits' => 'include_commits', 'includeRefUpdates' => 'include_ref_updates', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

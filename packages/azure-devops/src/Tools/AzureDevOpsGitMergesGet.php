<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a specific merge operation's details..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/merges/{mergeOperationId}.
 */
class AzureDevOpsGitMergesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_merges_get';
    protected const DESCRIPTION = 'Get a specific merge operation\'s details.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/merges/{mergeOperationId} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_name_or_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'merge_operation_id' => ['type' => 'number', 'required' => true, 'description' => 'OperationId of the merge request.'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include links'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/merges/{mergeOperationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryNameOrId' => 'repository_name_or_id', 'mergeOperationId' => 'merge_operation_id'];
    protected const QUERY_PARAMS = ['includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

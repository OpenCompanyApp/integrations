<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Request a git merge operation. Currently we support merging only 2 commits..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/merges.
 */
class AzureDevOpsGitMergesCreate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_merges_create';
    protected const DESCRIPTION = 'Request a git merge operation. Currently we support merging only 2 commits.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/merges (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Parents commitIds and merge commit messsage.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository_name_or_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => 'True to include links'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/merges';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repositoryNameOrId' => 'repository_name_or_id'];
    protected const QUERY_PARAMS = ['includeLinks' => 'include_links', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

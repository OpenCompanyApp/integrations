<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Queries the provided repository for its refs and returns them..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/refs.
 */
class AzureDevOpsGitRefsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_refs_list';
    protected const DESCRIPTION = 'Queries the provided repository for its refs and returns them.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/refs (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'filter' => ['type' => 'string', 'required' => false, 'description' => '[optional] A filter to apply to the refs (starts with).'], 'include_links' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] Specifies if referenceLinks should be included in the result. default is false.'], 'include_statuses' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] Includes up to the first 1000 commit statuses for each ref. The default value is false.'], 'include_my_branches' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] Includes only branches that the user owns, the branches the user favorites, and the default branch. The default value is false. Cannot be combined with the filter parameter.'], 'latest_statuses_only' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] True to include only the tip commit status for each ref. This option requires `includeStatuses` to be true. The default value is false.'], 'peel_tags' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] Annotated tags will populate the PeeledObjectId property. default is false.'], 'filter_contains' => ['type' => 'string', 'required' => false, 'description' => '[optional] A filter to apply to the refs (contains).'], 'top' => ['type' => 'number', 'required' => false, 'description' => '[optional] Maximum number of refs to return. It cannot be bigger than 1000. If it is not provided but continuationToken is, top will default to 100.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'The continuation token used for pagination.'], 'include_target_branches' => ['type' => 'boolean', 'required' => false, 'description' => '[optional] Includes target branches defined by patterns in pull_request_targets.yml.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/refs';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['filter' => 'filter', 'includeLinks' => 'include_links', 'includeStatuses' => 'include_statuses', 'includeMyBranches' => 'include_my_branches', 'latestStatusesOnly' => 'latest_statuses_only', 'peelTags' => 'peel_tags', 'filterContains' => 'filter_contains', '$top' => 'top', 'continuationToken' => 'continuation_token', 'includeTargetBranches' => 'include_target_branches', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

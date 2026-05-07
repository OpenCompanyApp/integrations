<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Find the merge bases of two commits, optionally across forks. If otherRepositoryId is not specified, the merge bases will only be calculated within the context of the local repositoryNameOrId..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/commits/{commitId}/mergebases.
 */
class AzureDevOpsGitMergeBasesList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_merge_bases_list';
    protected const DESCRIPTION = 'Find the merge bases of two commits, optionally across forks. If otherRepositoryId is not specified, the merge bases will only be calculated within the context of the local repositoryNameOrId.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/commits/{commitId}/mergebases (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_name_or_id' => ['type' => 'string', 'required' => true, 'description' => 'ID or name of the local repository.'], 'commit_id' => ['type' => 'string', 'required' => true, 'description' => 'First commit, usually the tip of the target branch of the potential merge.'], 'other_commit_id' => ['type' => 'string', 'required' => false, 'description' => 'Other commit, usually the tip of the source branch of the potential merge.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'other_collection_id' => ['type' => 'string', 'required' => false, 'description' => 'The collection ID where otherCommitId lives.'], 'other_repository_id' => ['type' => 'string', 'required' => false, 'description' => 'The repository ID where otherCommitId lives.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryNameOrId}/commits/{commitId}/mergebases';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryNameOrId' => 'repository_name_or_id', 'commitId' => 'commit_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['otherCommitId' => 'other_commit_id', 'otherCollectionId' => 'other_collection_id', 'otherRepositoryId' => 'other_repository_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

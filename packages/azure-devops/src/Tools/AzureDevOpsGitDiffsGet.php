<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Find the closest common commit (the merge base) between base and target commits, and get the diff between either the base and target commits or common and target commits..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/diffs/commits.
 */
class AzureDevOpsGitDiffsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_diffs_get';
    protected const DESCRIPTION = 'Find the closest common commit (the merge base) between base and target commits, and get the diff between either the base and target commits or common and target commits.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/diffs/commits (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'diff_common_commit' => ['type' => 'boolean', 'required' => false, 'description' => 'If true, diff between common and target commits. If false, diff between base and target commits.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of changes to return. Defaults to 100.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of changes to skip'], 'base_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'base_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'base_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'target_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'target_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'target_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/diffs/commits';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['diffCommonCommit' => 'diff_common_commit', '$top' => 'top', '$skip' => 'skip', 'baseVersion' => 'base_version', 'baseVersionOptions' => 'base_version_options', 'baseVersionType' => 'base_version_type', 'targetVersion' => 'target_version', 'targetVersionOptions' => 'target_version_options', 'targetVersionType' => 'target_version_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

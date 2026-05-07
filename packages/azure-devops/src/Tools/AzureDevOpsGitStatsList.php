<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve statistics about all branches within a repository..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/stats/branches.
 */
class AzureDevOpsGitStatsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_stats_list';
    protected const DESCRIPTION = 'Retrieve statistics about all branches within a repository.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/stats/branches (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'base_version_descriptor_version' => ['type' => 'string', 'required' => false, 'description' => 'Version string identifier (name of tag/branch, SHA1 of commit)'], 'base_version_descriptor_version_options' => ['type' => 'string', 'required' => false, 'description' => 'Version options - Specify additional modifiers to version (e.g Previous)'], 'base_version_descriptor_version_type' => ['type' => 'string', 'required' => false, 'description' => 'Version type (branch, tag, or commit). Determines how Id is interpreted'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/stats/branches';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['baseVersionDescriptor.version' => 'base_version_descriptor_version', 'baseVersionDescriptor.versionOptions' => 'base_version_descriptor_version_options', 'baseVersionDescriptor.versionType' => 'base_version_descriptor_version_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

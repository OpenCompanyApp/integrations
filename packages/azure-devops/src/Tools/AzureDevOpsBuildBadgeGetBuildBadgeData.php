<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets a badge that indicates the status of the most recent build for the specified branch..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/build/repos/{repoType}/badge.
 */
class AzureDevOpsBuildBadgeGetBuildBadgeData extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_build_badge_get_build_badge_data';
    protected const DESCRIPTION = 'Gets a badge that indicates the status of the most recent build for the specified branch.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/build/repos/{repoType}/badge (spec: build/7.2/build.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repo_type' => ['type' => 'string', 'required' => true, 'description' => 'The repository type.'], 'repo_id' => ['type' => 'string', 'required' => false, 'description' => 'The repository ID.'], 'branch_name' => ['type' => 'string', 'required' => false, 'description' => 'The branch name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/build/repos/{repoType}/badge';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repoType' => 'repo_type'];
    protected const QUERY_PARAMS = ['repoId' => 'repo_id', 'branchName' => 'branch_name', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Retrieve the changes made in a pull request between two iterations..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/changes.
 */
class AzureDevOpsGitPullRequestIterationChangesGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_iteration_changes_get';
    protected const DESCRIPTION = 'Retrieve the changes made in a pull request between two iterations.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/changes (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request\'s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'iteration_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request iteration. <br /> Iteration one is the head of the source branch at the time the pull request is created and subsequent iterations are created when there are pushes to the source branch. Allowed values are between 1 and the maximum iteration on this pull request.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Optional. The number of changes to retrieve. The default value is 100 and the maximum value is 2000.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Optional. The number of changes to ignore. For example, to retrieve changes 101-150, set top 50 and skip to 100.'], 'compare_to' => ['type' => 'number', 'required' => false, 'description' => 'ID of the pull request iteration to compare against. The default value is zero which indicates the comparison is made against the common commit between the source and target branches'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/iterations/{iterationId}/changes';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'iterationId' => 'iteration_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$compareTo' => 'compare_to', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

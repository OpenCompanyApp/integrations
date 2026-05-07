<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Removes a label (tag) from the set of those assigned to the pull request. The tag itself will not be deleted..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/labels/{labelIdOrName}.
 */
class AzureDevOpsGitPullRequestLabelsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_labels_delete';
    protected const DESCRIPTION = 'Removes a label (tag) from the set of those assigned to the pull request. The tag itself will not be deleted.

Official Azure DevOps REST API 7.2 endpoint: DELETE https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/labels/{labelIdOrName} (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'The repository ID of the pull request’s target branch.'], 'pull_request_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the pull request.'], 'label_id_or_name' => ['type' => 'string', 'required' => true, 'description' => 'The name or ID of the label requested.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'project_id' => ['type' => 'string', 'required' => false, 'description' => 'Project ID or project name.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullRequests/{pullRequestId}/labels/{labelIdOrName}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'pullRequestId' => 'pull_request_id', 'labelIdOrName' => 'label_id_or_name', 'project' => 'project'];
    protected const QUERY_PARAMS = ['projectId' => 'project_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

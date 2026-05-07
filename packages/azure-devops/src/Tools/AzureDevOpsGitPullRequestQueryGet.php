<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * This API is used to find what pull requests are related to a given commit. It can be used to either find the pull request that created a particular merge commit or it can be used to find all pull requests that have ever merged a particular commit. The input is a list of queries which each contain a list of commits. For each commit that you search against, you will get back a dictionary of commit -> pull requests..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequestquery.
 */
class AzureDevOpsGitPullRequestQueryGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_git_pull_request_query_get';
    protected const DESCRIPTION = 'This API is used to find what pull requests are related to a given commit. It can be used to either find the pull request that created a particular merge commit or it can be used to find all pull requests that have ever merged a particular commit. The input is a list of queries which each contain a list of commits. For each commit that you search against, you will get back a dictionary of commit -> pull requests.

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequestquery (spec: git/7.2/git.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The list of queries to perform.'], 'repository_id' => ['type' => 'string', 'required' => true, 'description' => 'ID of the repository.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/git/repositories/{repositoryId}/pullrequestquery';
    protected const PATH_PARAMS = ['organization' => 'organization', 'repositoryId' => 'repository_id', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Returns the branches for which analysis results were submitted..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/filters/branches.
 */
class AzureDevOpsAdvancedSecurityAnalysisList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_advanced_security_analysis_list';
    protected const DESCRIPTION = 'Returns the branches for which analysis results were submitted.

Official Azure DevOps REST API 7.2 endpoint: GET https://advsec.dev.azure.com/{organization}/{project}/_apis/alert/repositories/{repository}/filters/branches (spec: advancedSecurity/7.2/alert.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'repository' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `repository`.'], 'alert_type' => ['type' => 'string', 'required' => false, 'description' => 'The type of alert: Dependency Scanning (1), Secret (2), Code QL (3), etc.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'A string variable that represents the branch name and is used to fetch branches that follow it in alphabetical order.'], 'branch_name_contains' => ['type' => 'string', 'required' => false, 'description' => 'A string variable used to fetch branches that contain this string anywhere in the branch name, case insensitive.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'An int variable used to return the top k branches that satisfy the search criteria.'], 'include_pull_request_branches' => ['type' => 'boolean', 'required' => false, 'description' => 'A bool variable indicating whether or not to include pull request branches.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'advsec.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/alert/repositories/{repository}/filters/branches';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'repository' => 'repository'];
    protected const QUERY_PARAMS = ['alertType' => 'alert_type', 'continuationToken' => 'continuation_token', 'branchNameContains' => 'branch_name_contains', 'top' => 'top', 'includePullRequestBranches' => 'include_pull_request_branches', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

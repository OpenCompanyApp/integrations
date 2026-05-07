<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * OAuth callback endpoint. GitHub redirects here after user authorizes. Exchanges the authorization code for tokens and stores them in TCM StrongBox. Requires the callback URL to be registered in the GitHub OAuth App settings..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testai/completegithubauth.
 */
class AzureDevOpsTestResultsTestaiCompleteGitHubAuth extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testai_complete_git_hub_auth';
    protected const DESCRIPTION = 'OAuth callback endpoint. GitHub redirects here after user authorizes. Exchanges the authorization code for tokens and stores them in TCM StrongBox. Requires the callback URL to be registered in the GitHub OAuth App settings.

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testai/completegithubauth (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'code' => ['type' => 'string', 'required' => false, 'description' => 'The authorization code returned by GitHub after user consent'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/testai/completegithubauth';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['code' => 'code', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

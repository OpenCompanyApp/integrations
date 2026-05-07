<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get test results for a test run..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/results.
 */
class AzureDevOpsTestResultsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_list';
    protected const DESCRIPTION = 'Get test results for a test run.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/results (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'Test run ID of test results to fetch.'], 'details_to_include' => ['type' => 'string', 'required' => false, 'description' => 'Details to include with test results. Default is None. Other values are Iterations and WorkItems.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of test results to skip from beginning.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of test results to return. Maximum is 1000 when detailsToInclude is None and 200 otherwise.'], 'outcomes' => ['type' => 'string', 'required' => false, 'description' => 'Comma separated list of test outcomes to filter test results.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.6`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Runs/{runId}/results';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['detailsToInclude' => 'details_to_include', '$skip' => 'skip', '$top' => 'top', 'outcomes' => 'outcomes', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.6';
}

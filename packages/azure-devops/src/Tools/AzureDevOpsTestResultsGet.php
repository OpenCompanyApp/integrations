<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a test result for a test run..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/results/{testCaseResultId}.
 */
class AzureDevOpsTestResultsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_get';
    protected const DESCRIPTION = 'Get a test result for a test run.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/results/{testCaseResultId} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'Test run ID of a test result to fetch.'], 'test_case_result_id' => ['type' => 'number', 'required' => true, 'description' => 'Test result ID.'], 'details_to_include' => ['type' => 'string', 'required' => false, 'description' => 'Details to include with test results. Default is None. Other values are Iterations, WorkItems and SubResults.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.6`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Runs/{runId}/results/{testCaseResultId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testCaseResultId' => 'test_case_result_id'];
    protected const QUERY_PARAMS = ['detailsToInclude' => 'details_to_include', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.6';
}

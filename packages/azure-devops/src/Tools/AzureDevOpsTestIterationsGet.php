<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get iteration for a result.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/Results/{testCaseResultId}/iterations/{iterationId}.
 */
class AzureDevOpsTestIterationsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_iterations_get';
    protected const DESCRIPTION = 'Get iteration for a result

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Runs/{runId}/Results/{testCaseResultId}/iterations/{iterationId} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test run that contains the result.'], 'test_case_result_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test result that contains the iterations.'], 'iteration_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the test results Iteration.'], 'include_action_results' => ['type' => 'boolean', 'required' => false, 'description' => 'Include result details for each action performed in the test iteration. ActionResults refer to outcome (pass/fail) of test steps that are executed as part of a running a manual test. Including the ActionResults flag gets the outcome of test steps in the actionResults section and test parameters in the parameters section for each test iteration.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Runs/{runId}/Results/{testCaseResultId}/iterations/{iterationId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testCaseResultId' => 'test_case_result_id', 'iterationId' => 'iteration_id'];
    protected const QUERY_PARAMS = ['includeActionResults' => 'include_action_results', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

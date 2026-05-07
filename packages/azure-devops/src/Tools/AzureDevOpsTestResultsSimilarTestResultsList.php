<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Gets the list of results whose failure matches with the provided one..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}/similartestresults.
 */
class AzureDevOpsTestResultsSimilarTestResultsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_similar_test_results_list';
    protected const DESCRIPTION = 'Gets the list of results whose failure matches with the provided one.

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}/similartestresults (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'id of test run'], 'test_result_id' => ['type' => 'number', 'required' => true, 'description' => 'id of test result inside a test run'], 'test_sub_result_id' => ['type' => 'number', 'required' => false, 'description' => 'id of subresult inside a test result'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of results to return'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Header to pass the continuationToken'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}/similartestresults';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testResultId' => 'test_result_id'];
    protected const QUERY_PARAMS = ['testSubResultId' => 'test_sub_result_id', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = ['continuationToken' => 'continuation_token'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

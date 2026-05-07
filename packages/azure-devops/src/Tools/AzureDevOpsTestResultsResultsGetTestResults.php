<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/runs/{runId}/results.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results.
 */
class AzureDevOpsTestResultsResultsGetTestResults extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_results_get_test_results';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/runs/{runId}/results

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `runId`.'], 'details_to_include' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `detailsToInclude`.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$skip`.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$top`.'], 'outcomes' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `outcomes`.'], 'new_tests_only' => ['type' => 'boolean', 'required' => false, 'description' => 'query parameter `$newTestsOnly`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['detailsToInclude' => 'details_to_include', '$skip' => 'skip', '$top' => 'top', 'outcomes' => 'outcomes', '$newTestsOnly' => 'new_tests_only', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

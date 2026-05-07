<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}.
 */
class AzureDevOpsTestResultsResultsGetTestResultById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_results_get_test_result_by_id';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `runId`.'], 'test_result_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `testResultId`.'], 'details_to_include' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `detailsToInclude`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testResultId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testResultId' => 'test_result_id'];
    protected const QUERY_PARAMS = ['detailsToInclude' => 'details_to_include', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/workitems.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/workitems.
 */
class AzureDevOpsTestResultsWorkitemsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_workitems_list';
    protected const DESCRIPTION = 'GET /{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/workitems

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/workitems (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `runId`.'], 'test_case_result_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `testCaseResultId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results/{testCaseResultId}/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'testCaseResultId' => 'test_case_result_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

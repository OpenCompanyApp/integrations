<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * DELETE /{organization}/{project}/_apis/testresults/runs/{runId}.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}.
 */
class AzureDevOpsTestResultsRunsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_runs_delete';
    protected const DESCRIPTION = 'DELETE /{organization}/{project}/_apis/testresults/runs/{runId}

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `runId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

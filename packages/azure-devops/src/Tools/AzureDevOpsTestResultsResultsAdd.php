<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * POST /{organization}/{project}/_apis/testresults/runs/{runId}/results.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results.
 */
class AzureDevOpsTestResultsResultsAdd extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_results_add';
    protected const DESCRIPTION = 'POST /{organization}/{project}/_apis/testresults/runs/{runId}/results

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Azure DevOps Swagger schema.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `runId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

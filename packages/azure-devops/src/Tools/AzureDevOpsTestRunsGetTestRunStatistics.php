<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get test run statistics , used when we want to get summary of a run by outcome..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/runs/{runId}/Statistics.
 */
class AzureDevOpsTestRunsGetTestRunStatistics extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_runs_get_test_run_statistics';
    protected const DESCRIPTION = 'Get test run statistics , used when we want to get summary of a run by outcome.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/runs/{runId}/Statistics (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the run to get.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/runs/{runId}/Statistics';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

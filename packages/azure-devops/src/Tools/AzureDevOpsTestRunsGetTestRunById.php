<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a test run by its ID..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/runs/{runId}.
 */
class AzureDevOpsTestRunsGetTestRunById extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_runs_get_test_run_by_id';
    protected const DESCRIPTION = 'Get a test run by its ID.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/runs/{runId} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the run to get.'], 'include_details' => ['type' => 'boolean', 'required' => false, 'description' => 'Default value is true. It includes details like run statistics, release, build, test environment, post process state, and more.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/runs/{runId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['includeDetails' => 'include_details', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get list of test run attachments reference.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/testlog.
 */
class AzureDevOpsTestResultsTestlogGetTestRunLogs extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testlog_get_test_run_logs';
    protected const DESCRIPTION = 'Get list of test run attachments reference

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/testlog (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the test run'], 'type' => ['type' => 'string', 'required' => false, 'description' => 'type of the attachments to get'], 'directory_path' => ['type' => 'string', 'required' => false, 'description' => 'directory path for which attachments are needed'], 'file_name_prefix' => ['type' => 'string', 'required' => false, 'description' => 'file name prefix to filter the list of attachment'], 'fetch_meta_data' => ['type' => 'boolean', 'required' => false, 'description' => 'Default is false, set if metadata is needed'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of attachments reference to return'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Header to pass the continuationToken'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/testlog';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id'];
    protected const QUERY_PARAMS = ['type' => 'type', 'directoryPath' => 'directory_path', 'fileNamePrefix' => 'file_name_prefix', 'fetchMetaData' => 'fetch_meta_data', 'top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = ['continuationToken' => 'continuation_token'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

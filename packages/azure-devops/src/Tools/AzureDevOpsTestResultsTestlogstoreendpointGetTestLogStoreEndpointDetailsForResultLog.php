<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get SAS Uri of a test results attachment.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{resultId}/testlogstoreendpoint.
 */
class AzureDevOpsTestResultsTestlogstoreendpointGetTestLogStoreEndpointDetailsForResultLog extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testlogstoreendpoint_get_test_log_store_endpoint_details_for_result_log';
    protected const DESCRIPTION = 'Get SAS Uri of a test results attachment

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{resultId}/testlogstoreendpoint (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the test run that contains result'], 'result_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the test result whose files need to be downloaded'], 'type' => ['type' => 'string', 'required' => false, 'description' => 'type of the file'], 'file_path' => ['type' => 'string', 'required' => false, 'description' => 'filePath for which sas uri is needed'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results/{resultId}/testlogstoreendpoint';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'resultId' => 'result_id'];
    protected const QUERY_PARAMS = ['type' => 'type', 'filePath' => 'file_path', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

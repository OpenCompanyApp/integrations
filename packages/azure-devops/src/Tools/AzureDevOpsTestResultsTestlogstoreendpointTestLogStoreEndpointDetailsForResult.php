<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create empty file for a result and Get Sas uri for the file.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{resultId}/testlogstoreendpoint.
 */
class AzureDevOpsTestResultsTestlogstoreendpointTestLogStoreEndpointDetailsForResult extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testlogstoreendpoint_test_log_store_endpoint_details_for_result';
    protected const DESCRIPTION = 'Create empty file for a result and Get Sas uri for the file

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/runs/{runId}/results/{resultId}/testlogstoreendpoint (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'run_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the test run that contains the result'], 'result_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the test results that contains sub result'], 'sub_result_id' => ['type' => 'number', 'required' => false, 'description' => 'Id of the test sub result whose file sas uri is needed'], 'file_path' => ['type' => 'string', 'required' => false, 'description' => 'file path inside the sub result for which sas uri is needed'], 'type' => ['type' => 'string', 'required' => false, 'description' => 'Type of the file for download'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/runs/{runId}/results/{resultId}/testlogstoreendpoint';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'runId' => 'run_id', 'resultId' => 'result_id'];
    protected const QUERY_PARAMS = ['subResultId' => 'sub_result_id', 'filePath' => 'file_path', 'type' => 'type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

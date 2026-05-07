<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Create and Get sas uri of the build container.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testlogstoreendpoint.
 */
class AzureDevOpsTestResultsTestlogstoreendpointTestLogStoreEndpointDetailsForBuild extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testlogstoreendpoint_test_log_store_endpoint_details_for_build';
    protected const DESCRIPTION = 'Create and Get sas uri of the build container

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testlogstoreendpoint (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'build_id' => ['type' => 'number', 'required' => false, 'description' => 'Id of the build to get'], 'test_log_store_operation_type' => ['type' => 'string', 'required' => false, 'description' => 'Type of operation to perform using sas uri'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Azure DevOps Swagger schema.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/testlogstoreendpoint';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['buildId' => 'build_id', 'testLogStoreOperationType' => 'test_log_store_operation_type', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Deletes a test failure type with specified failureTypeId.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testfailuretype/{failureTypeId}.
 */
class AzureDevOpsTestResultsTestfailuretypeDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_testfailuretype_delete';
    protected const DESCRIPTION = 'Deletes a test failure type with specified failureTypeId

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testfailuretype/{failureTypeId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'failure_type_id' => ['type' => 'number', 'required' => true, 'description' => 'path parameter `failureTypeId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/testfailuretype/{failureTypeId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'failureTypeId' => 'failure_type_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

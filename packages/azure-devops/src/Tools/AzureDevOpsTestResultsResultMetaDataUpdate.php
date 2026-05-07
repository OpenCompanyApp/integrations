<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update properties of test result meta data.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/resultmetadata/{testCaseReferenceId}.
 */
class AzureDevOpsTestResultsResultMetaDataUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_result_meta_data_update';
    protected const DESCRIPTION = 'Update properties of test result meta data

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/resultmetadata/{testCaseReferenceId} (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'TestResultMetaData update input TestResultMetaDataUpdateInput'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_case_reference_id' => ['type' => 'number', 'required' => true, 'description' => 'TestCaseReference Id of Test Result to be updated.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.4`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/results/resultmetadata/{testCaseReferenceId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'testCaseReferenceId' => 'test_case_reference_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.4';
}

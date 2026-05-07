<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get history of a test method using TestHistoryQuery.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/testhistory.
 */
class AzureDevOpsTestResultsTestHistoryQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_test_history_query';
    protected const DESCRIPTION = 'Get history of a test method using TestHistoryQuery

Official Azure DevOps REST API 7.2 endpoint: POST https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/testhistory (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'TestHistoryQuery to get history'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/results/testhistory';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

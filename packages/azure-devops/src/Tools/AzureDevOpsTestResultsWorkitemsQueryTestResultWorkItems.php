<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Query Test Result WorkItems based on filter.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/workitems.
 */
class AzureDevOpsTestResultsWorkitemsQueryTestResultWorkItems extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_workitems_query_test_result_work_items';
    protected const DESCRIPTION = 'Query Test Result WorkItems based on filter

Official Azure DevOps REST API 7.2 endpoint: GET https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/results/workitems (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'work_item_category' => ['type' => 'string', 'required' => false, 'description' => 'can take values Microsoft.BugCategory or all(for getting all workitems)'], 'automated_test_name' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `automatedTestName`.'], 'test_case_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `testCaseId`.'], 'max_complete_date' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `maxCompleteDate`.'], 'days' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `days`.'], 'work_item_count' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `$workItemCount`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/results/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['workItemCategory' => 'work_item_category', 'automatedTestName' => 'automated_test_name', 'testCaseId' => 'test_case_id', 'maxCompleteDate' => 'max_complete_date', 'days' => 'days', '$workItemCount' => 'work_item_count', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

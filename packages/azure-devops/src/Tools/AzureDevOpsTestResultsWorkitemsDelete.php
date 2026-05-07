<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * DELETE /{organization}/{project}/_apis/testresults/testmethods/workitems.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testmethods/workitems.
 */
class AzureDevOpsTestResultsWorkitemsDelete extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_results_workitems_delete';
    protected const DESCRIPTION = 'DELETE /{organization}/{project}/_apis/testresults/testmethods/workitems

Official Azure DevOps REST API 7.2 endpoint: DELETE https://vstmr.dev.azure.com/{organization}/{project}/_apis/testresults/testmethods/workitems (spec: testResults/7.2/testResults.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'test_name' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `testName`.'], 'work_item_id' => ['type' => 'number', 'required' => false, 'description' => 'query parameter `workItemId`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'DELETE';
    protected const HOST = 'vstmr.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testresults/testmethods/workitems';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['testName' => 'test_name', 'workItemId' => 'work_item_id', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

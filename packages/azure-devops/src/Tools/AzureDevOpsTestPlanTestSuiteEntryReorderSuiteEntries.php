<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Reorder test suite entries in the test suite..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/suiteentry/{suiteId}.
 */
class AzureDevOpsTestPlanTestSuiteEntryReorderSuiteEntries extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_suite_entry_reorder_suite_entries';
    protected const DESCRIPTION = 'Reorder test suite entries in the test suite.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/suiteentry/{suiteId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'List of SuiteEntry to reorder.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the parent test suite.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/suiteentry/{suiteId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

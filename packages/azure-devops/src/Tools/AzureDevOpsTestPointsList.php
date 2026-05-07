<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of test points..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/Suites/{suiteId}/points.
 */
class AzureDevOpsTestPointsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_points_list';
    protected const DESCRIPTION = 'Get a list of test points.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/Suites/{suiteId}/points (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the suite that contains the points.'], 'wit_fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated list of work item field names.'], 'configuration_id' => ['type' => 'string', 'required' => false, 'description' => 'Get test points for specific configuration.'], 'test_case_id' => ['type' => 'string', 'required' => false, 'description' => 'Get test points for a specific test case, valid when configurationId is not set.'], 'test_point_ids' => ['type' => 'string', 'required' => false, 'description' => 'Get test points for comma-separated list of test point IDs, valid only when configurationId and testCaseId are not set.'], 'include_point_details' => ['type' => 'boolean', 'required' => false, 'description' => 'Include all properties for the test point.'], 'skip' => ['type' => 'number', 'required' => false, 'description' => 'Number of test points to skip..'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of test points to return.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Plans/{planId}/Suites/{suiteId}/points';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['witFields' => 'wit_fields', 'configurationId' => 'configuration_id', 'testCaseId' => 'test_case_id', 'testPointIds' => 'test_point_ids', 'includePointDetails' => 'include_point_details', '$skip' => 'skip', '$top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

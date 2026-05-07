<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update Test Points. This is used to Reset test point to active, update the outcome of a test point or update the tester of a test point.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestPoint.
 */
class AzureDevOpsTestPlanTestPointUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_point_update';
    protected const DESCRIPTION = 'Update Test Points. This is used to Reset test point to active, update the outcome of a test point or update the tester of a test point

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestPoint (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'A TestPointUpdateParams Object.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan for which test points are requested.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test suite for which test points are requested.'], 'include_point_details' => ['type' => 'boolean', 'required' => false, 'description' => 'If set to false, will get a smaller payload containing only basic details about the test point object'], 'return_identity_ref' => ['type' => 'boolean', 'required' => false, 'description' => 'If set to true, returns the AssignedTo field in TestCaseReference as IdentityRef object.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Plans/{planId}/Suites/{suiteId}/TestPoint';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id'];
    protected const QUERY_PARAMS = ['includePointDetails' => 'include_point_details', 'returnIdentityRef' => 'return_identity_ref', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

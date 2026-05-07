<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a test point..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/Suites/{suiteId}/points/{pointIds}.
 */
class AzureDevOpsTestPointsGetPoint extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_points_get_point';
    protected const DESCRIPTION = 'Get a test point.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/test/Plans/{planId}/Suites/{suiteId}/points/{pointIds} (spec: test/7.2/test.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test plan.'], 'suite_id' => ['type' => 'number', 'required' => true, 'description' => 'ID of the suite that contains the point.'], 'point_ids' => ['type' => 'number', 'required' => true, 'description' => 'ID of the test point to get.'], 'wit_fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated list of work item field names.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/test/Plans/{planId}/Suites/{suiteId}/points/{pointIds}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id', 'suiteId' => 'suite_id', 'pointIds' => 'point_ids'];
    protected const QUERY_PARAMS = ['witFields' => 'wit_fields', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Restores the deleted test plan.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/recycleBin/testplan/{planId}.
 */
class AzureDevOpsTestPlanTestPlanRecycleBinRestoreDeletedTestPlan extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_plan_recycle_bin_restore_deleted_test_plan';
    protected const DESCRIPTION = 'Restores the deleted test plan

Official Azure DevOps REST API 7.2 endpoint: PATCH https://dev.azure.com/{organization}/{project}/_apis/testplan/recycleBin/testplan/{planId} (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'The model containing the restore information'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'plan_id' => ['type' => 'number', 'required' => true, 'description' => 'The ID of the test plan to restore'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/recycleBin/testplan/{planId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'planId' => 'plan_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Clone test plan.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint POST https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/CloneOperation.
 */
class AzureDevOpsTestPlanTestPlanCloneCloneTestPlan extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_test_plan_test_plan_clone_clone_test_plan';
    protected const DESCRIPTION = 'Clone test plan

Official Azure DevOps REST API 7.2 endpoint: POST https://dev.azure.com/{organization}/{project}/_apis/testplan/Plans/CloneOperation (spec: testPlan/7.2/testPlan.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Plan Clone Request Body detail TestPlanCloneRequest'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'deep_clone' => ['type' => 'boolean', 'required' => false, 'description' => 'Clones all the associated test cases as well'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'POST';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/testplan/Plans/CloneOperation';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['deepClone' => 'deep_clone', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

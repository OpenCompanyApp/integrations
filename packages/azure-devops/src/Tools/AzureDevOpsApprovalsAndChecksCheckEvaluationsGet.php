<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get details for a specific check evaluation.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/checks/runs/{checkSuiteId}.
 */
class AzureDevOpsApprovalsAndChecksCheckEvaluationsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_approvals_and_checks_check_evaluations_get';
    protected const DESCRIPTION = 'Get details for a specific check evaluation

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/checks/runs/{checkSuiteId} (spec: approvalsAndChecks/7.2/pipelinesChecks.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'check_suite_id' => ['type' => 'string', 'required' => true, 'description' => 'path parameter `checkSuiteId`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$expand`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.1`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/checks/runs/{checkSuiteId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'checkSuiteId' => 'check_suite_id'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.1';
}

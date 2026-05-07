<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get an approval..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/approvals/{approvalId}.
 */
class AzureDevOpsApprovalsAndChecksApprovalsGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_approvals_and_checks_approvals_get';
    protected const DESCRIPTION = 'Get an approval.

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/approvals/{approvalId} (spec: approvalsAndChecks/7.2/pipelinesapproval.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'approval_id' => ['type' => 'string', 'required' => true, 'description' => 'Id of the approval.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$expand`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/approvals/{approvalId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'approvalId' => 'approval_id'];
    protected const QUERY_PARAMS = ['$expand' => 'expand', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

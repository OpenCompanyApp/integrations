<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Update status of an approval.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/approvals/{approvalId}.
 */
class AzureDevOpsReleaseApprovalsUpdate extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_approvals_update';
    protected const DESCRIPTION = 'Update status of an approval

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/approvals/{approvalId} (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'ReleaseApproval object having status, approver and comments.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'approval_id' => ['type' => 'number', 'required' => true, 'description' => 'Id of the approval.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/approvals/{approvalId}';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project', 'approvalId' => 'approval_id'];
    protected const QUERY_PARAMS = ['api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

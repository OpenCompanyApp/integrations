<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * List Approvals. This can be used to get a set of pending approvals in a pipeline, on an user or for a resource...
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/approvals.
 */
class AzureDevOpsApprovalsAndChecksApprovalsQuery extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_approvals_and_checks_approvals_query';
    protected const DESCRIPTION = 'List Approvals. This can be used to get a set of pending approvals in a pipeline, on an user or for a resource..

Official Azure DevOps REST API 7.2 endpoint: GET https://dev.azure.com/{organization}/{project}/_apis/pipelines/approvals (spec: approvalsAndChecks/7.2/pipelinesapproval.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'approval_ids' => ['type' => 'string', 'required' => false, 'description' => 'List of approval Ids to get.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Include these additional details in the returned objects.'], 'assigned_to' => ['type' => 'string', 'required' => false, 'description' => 'List of user Ids approvals assigned to. Accepts user Ids, user descriptors or user emails.'], 'state' => ['type' => 'string', 'required' => false, 'description' => 'Approval status. Returns approvals of any status if not provided'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Maximum number of approvals to get.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/pipelines/approvals';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['approvalIds' => 'approval_ids', '$expand' => 'expand', 'assignedTo' => 'assigned_to', 'state' => 'state', 'top' => 'top', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

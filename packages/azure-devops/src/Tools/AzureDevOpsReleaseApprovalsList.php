<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a list of approvals.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/approvals.
 */
class AzureDevOpsReleaseApprovalsList extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_release_approvals_list';
    protected const DESCRIPTION = 'Get a list of approvals

Official Azure DevOps REST API 7.2 endpoint: GET https://vsrm.dev.azure.com/{organization}/{project}/_apis/release/approvals (spec: release/7.2/release.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'project' => ['type' => 'string', 'required' => true, 'description' => 'Project ID or project name'], 'assigned_to_filter' => ['type' => 'string', 'required' => false, 'description' => 'Approvals assigned to this user.'], 'status_filter' => ['type' => 'string', 'required' => false, 'description' => 'Approvals with this status. Default is \'pending\'.'], 'release_ids_filter' => ['type' => 'string', 'required' => false, 'description' => 'Approvals for release id(s) mentioned in the filter. Multiple releases can be mentioned by separating them with \',\' e.g. releaseIdsFilter=1,2,3,4.'], 'type_filter' => ['type' => 'string', 'required' => false, 'description' => 'Approval with this type.'], 'top' => ['type' => 'number', 'required' => false, 'description' => 'Number of approvals to get. Default is 50.'], 'continuation_token' => ['type' => 'number', 'required' => false, 'description' => 'Gets the approvals after the continuation token provided.'], 'query_order' => ['type' => 'string', 'required' => false, 'description' => 'Gets the results in the defined order of created approvals. Default is \'descending\'.'], 'include_my_group_approvals' => ['type' => 'boolean', 'required' => false, 'description' => '\'true\' to include my group approvals. Default is \'false\'.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsrm.dev.azure.com';
    protected const PATH = '/{organization}/{project}/_apis/release/approvals';
    protected const PATH_PARAMS = ['organization' => 'organization', 'project' => 'project'];
    protected const QUERY_PARAMS = ['assignedToFilter' => 'assigned_to_filter', 'statusFilter' => 'status_filter', 'releaseIdsFilter' => 'release_ids_filter', 'typeFilter' => 'type_filter', 'top' => 'top', 'continuationToken' => 'continuation_token', 'queryOrder' => 'query_order', 'includeMyGroupApprovals' => 'include_my_group_approvals', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

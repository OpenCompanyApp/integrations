<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * GET /{organization}/_apis/memberentitlements.
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsaex.dev.azure.com/{organization}/_apis/memberentitlements.
 */
class AzureDevOpsMemberEntitlementManagementMemberEntitlementsSearchMemberEntitlements extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_member_entitlements_search_member_entitlements';
    protected const DESCRIPTION = 'GET /{organization}/_apis/memberentitlements

Official Azure DevOps REST API 7.2 endpoint: GET https://vsaex.dev.azure.com/{organization}/_apis/memberentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `continuationToken`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `select`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$filter`.'], 'order_by' => ['type' => 'string', 'required' => false, 'description' => 'query parameter `$orderBy`.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.3`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/memberentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['continuationToken' => 'continuation_token', 'select' => 'select', '$filter' => 'filter', '$orderBy' => 'order_by', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.3';
}

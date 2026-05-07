<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get summary of Licenses, Extension, Projects, Groups and their assignments in the collection..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsaex.dev.azure.com/{organization}/_apis/userentitlementsummary.
 */
class AzureDevOpsMemberEntitlementManagementUserEntitlementSummaryGet extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_user_entitlement_summary_get';
    protected const DESCRIPTION = 'Get summary of Licenses, Extension, Projects, Groups and their assignments in the collection.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsaex.dev.azure.com/{organization}/_apis/userentitlementsummary (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Comma (",") separated list of properties to select. Supported property names are {AccessLevels, Licenses, Projects, Groups}.'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.2`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/userentitlementsummary';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['select' => 'select', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.2';
}

<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Get a paged set of user entitlements matching the filter and sort criteria built with properties that match the select input..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint GET https://vsaex.dev.azure.com/{organization}/_apis/userentitlements.
 */
class AzureDevOpsMemberEntitlementManagementUserEntitlementsSearchUserEntitlements extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_user_entitlements_search_user_entitlements';
    protected const DESCRIPTION = 'Get a paged set of user entitlements matching the filter and sort criteria built with properties that match the select input.

Official Azure DevOps REST API 7.2 endpoint: GET https://vsaex.dev.azure.com/{organization}/_apis/userentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'continuation_token' => ['type' => 'string', 'required' => false, 'description' => 'Continuation token for getting the next page of data set. If null is passed, gets the first page.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Comma (",") separated list of properties to select in the result entitlements. names of the properties are - \'Projects, \'Extensions\' and \'Grouprules\'.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Equality operators relating to searching user entitlements separated by and clauses. Valid filters include: licenseId, licenseStatus, userType, and name. licenseId: filters based on license assignment using license names. i.e. licenseId eq \'Account-Stakeholder\' or licenseId eq \'Account-Express\'. licenseStatus: filters based on license status. currently only supports disabled. i.e. licenseStatus eq \'Disabled\'. To get disabled basic licenses, you would pass (licenseId eq \'Account-Express\' and licenseStatus eq \'Disabled\'). userType: filters off identity type. Supported types are member or guest i.e. userType eq \'member\'. name: filters on if the user\'s display name or email contains given input. i.e. get all users with "test" in email or displayname is "name eq \'test\'". A valid query could be: (licenseId eq \'Account-Stakeholder\' or (licenseId eq \'Account-Express\' and licenseStatus eq \'Disabled\')) and name eq \'test\' and userType eq \'guest\'.'], 'order_by' => ['type' => 'string', 'required' => false, 'description' => 'PropertyName and Order (separated by a space ( )) to sort on (e.g. lastAccessed desc). Order defaults to ascending. valid properties to order by are dateCreated, lastAccessed, and name'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.5`.']];
    protected const METHOD = 'GET';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/userentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['continuationToken' => 'continuation_token', 'select' => 'select', '$filter' => 'filter', '$orderBy' => 'order_by', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.5';
}

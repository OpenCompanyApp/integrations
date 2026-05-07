<?php

namespace OpenCompany\Integrations\AzureDevOps\Tools;

/**
 * Edit the entitlements (License, Extensions, Projects, Teams etc) for one or more users. MSA Backed organizations may face limitation when using this API..
 *
 * Maps to Azure DevOps REST API 7.2 endpoint PATCH https://vsaex.dev.azure.com/{organization}/_apis/userentitlements.
 */
class AzureDevOpsMemberEntitlementManagementUserEntitlementsUpdateUserEntitlements extends AbstractAzureDevOpsTool
{
    protected const NAME = 'azure_devops_member_entitlement_management_user_entitlements_update_user_entitlements';
    protected const DESCRIPTION = 'Edit the entitlements (License, Extensions, Projects, Teams etc) for one or more users. MSA Backed organizations may face limitation when using this API.

Official Azure DevOps REST API 7.2 endpoint: PATCH https://vsaex.dev.azure.com/{organization}/_apis/userentitlements (spec: memberEntitlementManagement/7.2/memberEntitlementManagement.json).';
    protected const PARAMETERS = ['organization' => ['type' => 'string', 'required' => true, 'description' => 'The name of the Azure DevOps organization.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'JsonPatchDocument containing the operations to perform.'], 'do_not_send_invite_for_new_users' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to send email invites to new users or not'], 'api_version' => ['type' => 'string', 'required' => false, 'description' => 'Azure DevOps API version. Defaults to `7.2-preview.5`.']];
    protected const METHOD = 'PATCH';
    protected const HOST = 'vsaex.dev.azure.com';
    protected const PATH = '/{organization}/_apis/userentitlements';
    protected const PATH_PARAMS = ['organization' => 'organization'];
    protected const QUERY_PARAMS = ['doNotSendInviteForNewUsers' => 'do_not_send_invite_for_new_users', 'api-version' => 'api_version'];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
    protected const API_VERSION = '7.2-preview.5';
}

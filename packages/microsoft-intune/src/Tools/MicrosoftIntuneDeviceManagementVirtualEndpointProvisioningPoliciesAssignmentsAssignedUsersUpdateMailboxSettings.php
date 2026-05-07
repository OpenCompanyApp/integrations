<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Update property mailboxSettings value..
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /deviceManagement/virtualEndpoint/provisioningPolicies/{cloudPcProvisioningPolicy-id}/assignments/{cloudPcProvisioningPolicyAssignment-id}/assignedUsers/{user-id}/mailboxSettings.
 */
class MicrosoftIntuneDeviceManagementVirtualEndpointProvisioningPoliciesAssignmentsAssignedUsersUpdateMailboxSettings extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_virtual_endpoint_provisioning_policies_assignments_assigned_users_update_mailbox_settings';
    protected const DESCRIPTION = 'Update property mailboxSettings value.\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /deviceManagement/virtualEndpoint/provisioningPolicies/{cloudPcProvisioningPolicy-id}/assignments/{cloudPcProvisioningPolicyAssignment-id}/assignedUsers/{user-id}/mailboxSettings.';
    protected const PARAMETERS = ['cloud_pc_provisioning_policy_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `cloudPcProvisioningPolicy-id`.'], 'cloud_pc_provisioning_policy_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `cloudPcProvisioningPolicyAssignment-id`.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/deviceManagement/virtualEndpoint/provisioningPolicies/{cloudPcProvisioningPolicy-id}/assignments/{cloudPcProvisioningPolicyAssignment-id}/assignedUsers/{user-id}/mailboxSettings';
    protected const PATH_PARAMS = ['cloudPcProvisioningPolicy-id' => 'cloud_pc_provisioning_policy_id', 'cloudPcProvisioningPolicyAssignment-id' => 'cloud_pc_provisioning_policy_assignment_id', 'user-id' => 'user_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}

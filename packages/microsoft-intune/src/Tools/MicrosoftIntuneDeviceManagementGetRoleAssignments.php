<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get roleAssignments from deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceManagement/roleAssignments/{deviceAndAppManagementRoleAssignment-id}.
 */
class MicrosoftIntuneDeviceManagementGetRoleAssignments extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_get_role_assignments';
    protected const DESCRIPTION = 'Get roleAssignments from deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceManagement/roleAssignments/{deviceAndAppManagementRoleAssignment-id}.';
    protected const PARAMETERS = ['device_and_app_management_role_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `deviceAndAppManagementRoleAssignment-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceManagement/roleAssignments/{deviceAndAppManagementRoleAssignment-id}';
    protected const PATH_PARAMS = ['deviceAndAppManagementRoleAssignment-id' => 'device_and_app_management_role_assignment_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

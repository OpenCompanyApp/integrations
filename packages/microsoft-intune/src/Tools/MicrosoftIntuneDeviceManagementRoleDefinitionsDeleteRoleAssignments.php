<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Delete navigation property roleAssignments for deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /deviceManagement/roleDefinitions/{roleDefinition-id}/roleAssignments/{roleAssignment-id}.
 */
class MicrosoftIntuneDeviceManagementRoleDefinitionsDeleteRoleAssignments extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_role_definitions_delete_role_assignments';
    protected const DESCRIPTION = 'Delete navigation property roleAssignments for deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /deviceManagement/roleDefinitions/{roleDefinition-id}/roleAssignments/{roleAssignment-id}.';
    protected const PARAMETERS = ['role_definition_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `roleDefinition-id`.'], 'role_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `roleAssignment-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/deviceManagement/roleDefinitions/{roleDefinition-id}/roleAssignments/{roleAssignment-id}';
    protected const PATH_PARAMS = ['roleDefinition-id' => 'role_definition_id', 'roleAssignment-id' => 'role_assignment_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property roleAssignmentSchedules for roleManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /roleManagement/directory/roleAssignmentSchedules/{unifiedRoleAssignmentSchedule-id}.
 */
class MicrosoftEntraIdRoleManagementDirectoryDeleteRoleAssignmentSchedules extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_role_management_directory_delete_role_assignment_schedules';
    protected const DESCRIPTION = 'Delete navigation property roleAssignmentSchedules for roleManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /roleManagement/directory/roleAssignmentSchedules/{unifiedRoleAssignmentSchedule-id}.';
    protected const PARAMETERS = ['unified_role_assignment_schedule_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `unifiedRoleAssignmentSchedule-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/roleManagement/directory/roleAssignmentSchedules/{unifiedRoleAssignmentSchedule-id}';
    protected const PATH_PARAMS = ['unifiedRoleAssignmentSchedule-id' => 'unified_role_assignment_schedule_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

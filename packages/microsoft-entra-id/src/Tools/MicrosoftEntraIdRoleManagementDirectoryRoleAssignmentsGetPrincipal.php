<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get principal from roleManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /roleManagement/directory/roleAssignments/{unifiedRoleAssignment-id}/principal.
 */
class MicrosoftEntraIdRoleManagementDirectoryRoleAssignmentsGetPrincipal extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_role_management_directory_role_assignments_get_principal';
    protected const DESCRIPTION = 'Get principal from roleManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /roleManagement/directory/roleAssignments/{unifiedRoleAssignment-id}/principal.';
    protected const PARAMETERS = ['unified_role_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `unifiedRoleAssignment-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/roleManagement/directory/roleAssignments/{unifiedRoleAssignment-id}/principal';
    protected const PATH_PARAMS = ['unifiedRoleAssignment-id' => 'unified_role_assignment_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

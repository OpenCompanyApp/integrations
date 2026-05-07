<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete entity from directoryRoles by roleTemplateId.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /directoryRoles(roleTemplateId='{roleTemplateId}').
 */
class MicrosoftEntraIdDirectoryRolesDirectoryRoleDeleteDirectoryRoleByRoleTemplateId extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_directory_roles_directory_role_delete_directory_role_by_role_template_id';
    protected const DESCRIPTION = 'Delete entity from directoryRoles by roleTemplateId\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /directoryRoles(roleTemplateId=\'{roleTemplateId}\').';
    protected const PARAMETERS = ['role_template_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `roleTemplateId`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/directoryRoles(roleTemplateId=\'{roleTemplateId}\')';
    protected const PATH_PARAMS = ['roleTemplateId' => 'role_template_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

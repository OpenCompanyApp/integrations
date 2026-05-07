<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Create new navigation property to scopedMembers for directoryRoles.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /directoryRoles/{directoryRole-id}/scopedMembers.
 */
class MicrosoftEntraIdDirectoryRolesCreateScopedMembers extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_directory_roles_create_scoped_members';
    protected const DESCRIPTION = 'Create new navigation property to scopedMembers for directoryRoles\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /directoryRoles/{directoryRole-id}/scopedMembers.';
    protected const PARAMETERS = ['directory_role_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `directoryRole-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/directoryRoles/{directoryRole-id}/scopedMembers';
    protected const PATH_PARAMS = ['directoryRole-id' => 'directory_role_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}

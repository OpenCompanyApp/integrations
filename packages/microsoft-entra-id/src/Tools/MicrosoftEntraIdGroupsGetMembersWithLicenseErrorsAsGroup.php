<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get the item of type microsoft.graph.directoryObject as microsoft.graph.group.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /groups/{group-id}/membersWithLicenseErrors/{directoryObject-id}/graph.group.
 */
class MicrosoftEntraIdGroupsGetMembersWithLicenseErrorsAsGroup extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_groups_get_members_with_license_errors_as_group';
    protected const DESCRIPTION = 'Get the item of type microsoft.graph.directoryObject as microsoft.graph.group\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /groups/{group-id}/membersWithLicenseErrors/{directoryObject-id}/graph.group.';
    protected const PARAMETERS = ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `group-id`.'], 'directory_object_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `directoryObject-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/groups/{group-id}/membersWithLicenseErrors/{directoryObject-id}/graph.group';
    protected const PATH_PARAMS = ['group-id' => 'group_id', 'directoryObject-id' => 'directory_object_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

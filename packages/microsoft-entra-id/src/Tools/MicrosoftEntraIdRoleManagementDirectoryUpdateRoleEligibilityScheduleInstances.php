<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Update the navigation property roleEligibilityScheduleInstances in roleManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /roleManagement/directory/roleEligibilityScheduleInstances/{unifiedRoleEligibilityScheduleInstance-id}.
 */
class MicrosoftEntraIdRoleManagementDirectoryUpdateRoleEligibilityScheduleInstances extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_role_management_directory_update_role_eligibility_schedule_instances';
    protected const DESCRIPTION = 'Update the navigation property roleEligibilityScheduleInstances in roleManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /roleManagement/directory/roleEligibilityScheduleInstances/{unifiedRoleEligibilityScheduleInstance-id}.';
    protected const PARAMETERS = ['unified_role_eligibility_schedule_instance_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `unifiedRoleEligibilityScheduleInstance-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/roleManagement/directory/roleEligibilityScheduleInstances/{unifiedRoleEligibilityScheduleInstance-id}';
    protected const PATH_PARAMS = ['unifiedRoleEligibilityScheduleInstance-id' => 'unified_role_eligibility_schedule_instance_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}

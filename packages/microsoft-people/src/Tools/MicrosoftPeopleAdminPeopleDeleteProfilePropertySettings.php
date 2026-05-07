<?php

namespace OpenCompany\Integrations\MicrosoftPeople\Tools;

/**
 * Delete profilePropertySetting.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /admin/people/profilePropertySettings/{profilePropertySetting-id}.
 */
class MicrosoftPeopleAdminPeopleDeleteProfilePropertySettings extends AbstractMicrosoftPeopleTool
{
    protected const NAME = 'microsoft_people_admin_people_delete_profile_property_settings';
    protected const DESCRIPTION = 'Delete profilePropertySetting\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /admin/people/profilePropertySettings/{profilePropertySetting-id}.';
    protected const PARAMETERS = ['profile_property_setting_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `profilePropertySetting-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/admin/people/profilePropertySettings/{profilePropertySetting-id}';
    protected const PATH_PARAMS = ['profilePropertySetting-id' => 'profile_property_setting_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

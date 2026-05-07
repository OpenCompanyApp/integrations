<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property historyItems for users.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /users/{user-id}/activities/{userActivity-id}/historyItems/{activityHistoryItem-id}.
 */
class MicrosoftEntraIdUsersActivitiesDeleteHistoryItems extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_users_activities_delete_history_items';
    protected const DESCRIPTION = 'Delete navigation property historyItems for users\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /users/{user-id}/activities/{userActivity-id}/historyItems/{activityHistoryItem-id}.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'user_activity_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userActivity-id`.'], 'activity_history_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `activityHistoryItem-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/users/{user-id}/activities/{userActivity-id}/historyItems/{activityHistoryItem-id}';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'userActivity-id' => 'user_activity_id', 'activityHistoryItem-id' => 'activity_history_item_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

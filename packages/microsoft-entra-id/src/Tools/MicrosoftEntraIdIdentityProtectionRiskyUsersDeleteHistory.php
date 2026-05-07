<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property history for identityProtection.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /identityProtection/riskyUsers/{riskyUser-id}/history/{riskyUserHistoryItem-id}.
 */
class MicrosoftEntraIdIdentityProtectionRiskyUsersDeleteHistory extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_protection_risky_users_delete_history';
    protected const DESCRIPTION = 'Delete navigation property history for identityProtection\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /identityProtection/riskyUsers/{riskyUser-id}/history/{riskyUserHistoryItem-id}.';
    protected const PARAMETERS = ['risky_user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `riskyUser-id`.'], 'risky_user_history_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `riskyUserHistoryItem-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/identityProtection/riskyUsers/{riskyUser-id}/history/{riskyUserHistoryItem-id}';
    protected const PATH_PARAMS = ['riskyUser-id' => 'risky_user_id', 'riskyUserHistoryItem-id' => 'risky_user_history_item_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete navigation property details for security.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/attackSimulation/endUserNotifications/{endUserNotification-id}/details/{endUserNotificationDetail-id}.
 */
class MicrosoftGraphSecurityAttackSimulationEndUserNotificationsDeleteDetails extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_attack_simulation_end_user_notifications_delete_details';
    protected const DESCRIPTION = 'Delete navigation property details for security\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/attackSimulation/endUserNotifications/{endUserNotification-id}/details/{endUserNotificationDetail-id}.';
    protected const PARAMETERS = ['end_user_notification_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `endUserNotification-id`.'], 'end_user_notification_detail_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `endUserNotificationDetail-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/attackSimulation/endUserNotifications/{endUserNotification-id}/details/{endUserNotificationDetail-id}';
    protected const PATH_PARAMS = ['endUserNotification-id' => 'end_user_notification_id', 'endUserNotificationDetail-id' => 'end_user_notification_detail_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

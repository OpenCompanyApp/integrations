<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get localizedNotificationMessages from deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceManagement/notificationMessageTemplates/{notificationMessageTemplate-id}/localizedNotificationMessages/{localizedNotificationMessage-id}.
 */
class MicrosoftIntuneDeviceManagementNotificationMessageTemplatesGetLocalizedNotificationMessages extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_notification_message_templates_get_localized_notification_messages';
    protected const DESCRIPTION = 'Get localizedNotificationMessages from deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceManagement/notificationMessageTemplates/{notificationMessageTemplate-id}/localizedNotificationMessages/{localizedNotificationMessage-id}.';
    protected const PARAMETERS = ['notification_message_template_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `notificationMessageTemplate-id`.'], 'localized_notification_message_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `localizedNotificationMessage-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceManagement/notificationMessageTemplates/{notificationMessageTemplate-id}/localizedNotificationMessages/{localizedNotificationMessage-id}';
    protected const PATH_PARAMS = ['notificationMessageTemplate-id' => 'notification_message_template_id', 'localizedNotificationMessage-id' => 'localized_notification_message_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

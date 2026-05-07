<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Delete navigation property userExperienceAnalyticsMetricHistory for deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /deviceManagement/userExperienceAnalyticsMetricHistory/{userExperienceAnalyticsMetricHistory-id}.
 */
class MicrosoftIntuneDeviceManagementDeleteUserExperienceAnalyticsMetricHistory extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_delete_user_experience_analytics_metric_history';
    protected const DESCRIPTION = 'Delete navigation property userExperienceAnalyticsMetricHistory for deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /deviceManagement/userExperienceAnalyticsMetricHistory/{userExperienceAnalyticsMetricHistory-id}.';
    protected const PARAMETERS = ['user_experience_analytics_metric_history_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userExperienceAnalyticsMetricHistory-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/deviceManagement/userExperienceAnalyticsMetricHistory/{userExperienceAnalyticsMetricHistory-id}';
    protected const PATH_PARAMS = ['userExperienceAnalyticsMetricHistory-id' => 'user_experience_analytics_metric_history_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

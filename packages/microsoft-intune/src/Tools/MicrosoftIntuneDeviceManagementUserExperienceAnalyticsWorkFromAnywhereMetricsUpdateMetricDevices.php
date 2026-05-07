<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Update the navigation property metricDevices in deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /deviceManagement/userExperienceAnalyticsWorkFromAnywhereMetrics/{userExperienceAnalyticsWorkFromAnywhereMetric-id}/metricDevices/{userExperienceAnalyticsWorkFromAnywhereDevice-id}.
 */
class MicrosoftIntuneDeviceManagementUserExperienceAnalyticsWorkFromAnywhereMetricsUpdateMetricDevices extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_user_experience_analytics_work_from_anywhere_metrics_update_metric_devices';
    protected const DESCRIPTION = 'Update the navigation property metricDevices in deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /deviceManagement/userExperienceAnalyticsWorkFromAnywhereMetrics/{userExperienceAnalyticsWorkFromAnywhereMetric-id}/metricDevices/{userExperienceAnalyticsWorkFromAnywhereDevice-id}.';
    protected const PARAMETERS = ['user_experience_analytics_work_from_anywhere_metric_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userExperienceAnalyticsWorkFromAnywhereMetric-id`.'], 'user_experience_analytics_work_from_anywhere_device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userExperienceAnalyticsWorkFromAnywhereDevice-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/deviceManagement/userExperienceAnalyticsWorkFromAnywhereMetrics/{userExperienceAnalyticsWorkFromAnywhereMetric-id}/metricDevices/{userExperienceAnalyticsWorkFromAnywhereDevice-id}';
    protected const PATH_PARAMS = ['userExperienceAnalyticsWorkFromAnywhereMetric-id' => 'user_experience_analytics_work_from_anywhere_metric_id', 'userExperienceAnalyticsWorkFromAnywhereDevice-id' => 'user_experience_analytics_work_from_anywhere_device_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}

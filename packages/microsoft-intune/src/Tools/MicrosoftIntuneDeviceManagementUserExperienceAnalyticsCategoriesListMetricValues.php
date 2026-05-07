<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Get metricValues from deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /deviceManagement/userExperienceAnalyticsCategories/{userExperienceAnalyticsCategory-id}/metricValues.
 */
class MicrosoftIntuneDeviceManagementUserExperienceAnalyticsCategoriesListMetricValues extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_user_experience_analytics_categories_list_metric_values';
    protected const DESCRIPTION = 'Get metricValues from deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /deviceManagement/userExperienceAnalyticsCategories/{userExperienceAnalyticsCategory-id}/metricValues.';
    protected const PARAMETERS = ['user_experience_analytics_category_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userExperienceAnalyticsCategory-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/deviceManagement/userExperienceAnalyticsCategories/{userExperienceAnalyticsCategory-id}/metricValues';
    protected const PATH_PARAMS = ['userExperienceAnalyticsCategory-id' => 'user_experience_analytics_category_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

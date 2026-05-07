<?php

namespace OpenCompany\Integrations\MicrosoftIntune\Tools;

/**
 * Update the navigation property acceptanceStatuses in deviceManagement.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /deviceManagement/termsAndConditions/{termsAndConditions-id}/acceptanceStatuses/{termsAndConditionsAcceptanceStatus-id}.
 */
class MicrosoftIntuneDeviceManagementTermsAndConditionsUpdateAcceptanceStatuses extends AbstractMicrosoftIntuneTool
{
    protected const NAME = 'microsoft_intune_device_management_terms_and_conditions_update_acceptance_statuses';
    protected const DESCRIPTION = 'Update the navigation property acceptanceStatuses in deviceManagement\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /deviceManagement/termsAndConditions/{termsAndConditions-id}/acceptanceStatuses/{termsAndConditionsAcceptanceStatus-id}.';
    protected const PARAMETERS = ['terms_and_conditions_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `termsAndConditions-id`.'], 'terms_and_conditions_acceptance_status_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `termsAndConditionsAcceptanceStatus-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/deviceManagement/termsAndConditions/{termsAndConditions-id}/acceptanceStatuses/{termsAndConditionsAcceptanceStatus-id}';
    protected const PATH_PARAMS = ['termsAndConditions-id' => 'terms_and_conditions_id', 'termsAndConditionsAcceptanceStatus-id' => 'terms_and_conditions_acceptance_status_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}

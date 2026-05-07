<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get serviceProvisioningErrors property value.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /identityGovernance/privilegedAccess/group/eligibilityScheduleRequests/{privilegedAccessGroupEligibilityScheduleRequest-id}/group/serviceProvisioningErrors.
 */
class MicrosoftEntraIdIdentityGovernancePrivilegedAccessGroupEligibilityScheduleRequestsGroupListServiceProvisioningErrors extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_governance_privileged_access_group_eligibility_schedule_requests_group_list_service_provisioning_errors';
    protected const DESCRIPTION = 'Get serviceProvisioningErrors property value\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /identityGovernance/privilegedAccess/group/eligibilityScheduleRequests/{privilegedAccessGroupEligibilityScheduleRequest-id}/group/serviceProvisioningErrors.';
    protected const PARAMETERS = ['privileged_access_group_eligibility_schedule_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `privilegedAccessGroupEligibilityScheduleRequest-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/identityGovernance/privilegedAccess/group/eligibilityScheduleRequests/{privilegedAccessGroupEligibilityScheduleRequest-id}/group/serviceProvisioningErrors';
    protected const PATH_PARAMS = ['privilegedAccessGroupEligibilityScheduleRequest-id' => 'privileged_access_group_eligibility_schedule_request_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

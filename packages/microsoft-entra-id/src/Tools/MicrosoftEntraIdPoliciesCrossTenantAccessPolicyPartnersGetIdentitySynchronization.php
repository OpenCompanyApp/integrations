<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get crossTenantIdentitySyncPolicyPartner.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /policies/crossTenantAccessPolicy/partners/{crossTenantAccessPolicyConfigurationPartner-tenantId}/identitySynchronization.
 */
class MicrosoftEntraIdPoliciesCrossTenantAccessPolicyPartnersGetIdentitySynchronization extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_policies_cross_tenant_access_policy_partners_get_identity_synchronization';
    protected const DESCRIPTION = 'Get crossTenantIdentitySyncPolicyPartner\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /policies/crossTenantAccessPolicy/partners/{crossTenantAccessPolicyConfigurationPartner-tenantId}/identitySynchronization.';
    protected const PARAMETERS = ['cross_tenant_access_policy_configuration_partner_tenant_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `crossTenantAccessPolicyConfigurationPartner-tenantId`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/policies/crossTenantAccessPolicy/partners/{crossTenantAccessPolicyConfigurationPartner-tenantId}/identitySynchronization';
    protected const PATH_PARAMS = ['crossTenantAccessPolicyConfigurationPartner-tenantId' => 'cross_tenant_access_policy_configuration_partner_tenant_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

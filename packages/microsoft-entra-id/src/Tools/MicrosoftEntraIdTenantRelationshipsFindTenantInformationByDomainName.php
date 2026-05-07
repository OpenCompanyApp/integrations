<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke function findTenantInformationByDomainName.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /tenantRelationships/findTenantInformationByDomainName(domainName='{domainName}').
 */
class MicrosoftEntraIdTenantRelationshipsFindTenantInformationByDomainName extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_tenant_relationships_find_tenant_information_by_domain_name';
    protected const DESCRIPTION = 'Invoke function findTenantInformationByDomainName\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /tenantRelationships/findTenantInformationByDomainName(domainName=\'{domainName}\').';
    protected const PARAMETERS = ['domain_name' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `domainName`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/tenantRelationships/findTenantInformationByDomainName(domainName=\'{domainName}\')';
    protected const PATH_PARAMS = ['domainName' => 'domain_name'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

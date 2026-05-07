<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property serviceConfigurationRecords for domains.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /domains/{domain-id}/serviceConfigurationRecords/{domainDnsRecord-id}.
 */
class MicrosoftEntraIdDomainsDeleteServiceConfigurationRecords extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_domains_delete_service_configuration_records';
    protected const DESCRIPTION = 'Delete navigation property serviceConfigurationRecords for domains\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /domains/{domain-id}/serviceConfigurationRecords/{domainDnsRecord-id}.';
    protected const PARAMETERS = ['domain_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `domain-id`.'], 'domain_dns_record_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `domainDnsRecord-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/domains/{domain-id}/serviceConfigurationRecords/{domainDnsRecord-id}';
    protected const PATH_PARAMS = ['domain-id' => 'domain_id', 'domainDnsRecord-id' => 'domain_dns_record_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

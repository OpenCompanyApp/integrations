<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete siteSource.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/cases/ediscoveryCases/{ediscoveryCase-id}/custodians/{ediscoveryCustodian-id}/siteSources/{siteSource-id}.
 */
class MicrosoftGraphSecurityCasesEdiscoveryCasesCustodiansDeleteSiteSources extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_cases_ediscovery_cases_custodians_delete_site_sources';
    protected const DESCRIPTION = 'Delete siteSource\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/cases/ediscoveryCases/{ediscoveryCase-id}/custodians/{ediscoveryCustodian-id}/siteSources/{siteSource-id}.';
    protected const PARAMETERS = ['ediscovery_case_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `ediscoveryCase-id`.'], 'ediscovery_custodian_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `ediscoveryCustodian-id`.'], 'site_source_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `siteSource-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/cases/ediscoveryCases/{ediscoveryCase-id}/custodians/{ediscoveryCustodian-id}/siteSources/{siteSource-id}';
    protected const PATH_PARAMS = ['ediscoveryCase-id' => 'ediscovery_case_id', 'ediscoveryCustodian-id' => 'ediscovery_custodian_id', 'siteSource-id' => 'site_source_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

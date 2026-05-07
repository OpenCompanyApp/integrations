<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get relatedHosts from security.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/threatIntelligence/sslCertificates/{sslCertificate-id}/relatedHosts/{host-id}.
 */
class MicrosoftGraphSecurityThreatIntelligenceSslCertificatesGetRelatedHosts extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_threat_intelligence_ssl_certificates_get_related_hosts';
    protected const DESCRIPTION = 'Get relatedHosts from security\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/threatIntelligence/sslCertificates/{sslCertificate-id}/relatedHosts/{host-id}.';
    protected const PARAMETERS = ['ssl_certificate_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sslCertificate-id`.'], 'host_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `host-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/threatIntelligence/sslCertificates/{sslCertificate-id}/relatedHosts/{host-id}';
    protected const PATH_PARAMS = ['sslCertificate-id' => 'ssl_certificate_id', 'host-id' => 'host_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

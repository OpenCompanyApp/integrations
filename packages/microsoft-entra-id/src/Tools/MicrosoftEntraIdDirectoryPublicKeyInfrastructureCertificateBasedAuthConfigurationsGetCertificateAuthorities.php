<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get certificateAuthorities from directory.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /directory/publicKeyInfrastructure/certificateBasedAuthConfigurations/{certificateBasedAuthPki-id}/certificateAuthorities/{certificateAuthorityDetail-id}.
 */
class MicrosoftEntraIdDirectoryPublicKeyInfrastructureCertificateBasedAuthConfigurationsGetCertificateAuthorities extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_directory_public_key_infrastructure_certificate_based_auth_configurations_get_certificate_authorities';
    protected const DESCRIPTION = 'Get certificateAuthorities from directory\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /directory/publicKeyInfrastructure/certificateBasedAuthConfigurations/{certificateBasedAuthPki-id}/certificateAuthorities/{certificateAuthorityDetail-id}.';
    protected const PARAMETERS = ['certificate_based_auth_pki_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `certificateBasedAuthPki-id`.'], 'certificate_authority_detail_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `certificateAuthorityDetail-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/directory/publicKeyInfrastructure/certificateBasedAuthConfigurations/{certificateBasedAuthPki-id}/certificateAuthorities/{certificateAuthorityDetail-id}';
    protected const PATH_PARAMS = ['certificateBasedAuthPki-id' => 'certificate_based_auth_pki_id', 'certificateAuthorityDetail-id' => 'certificate_authority_detail_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

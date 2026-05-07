<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete certificateBasedAuthConfiguration.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /organization/{organization-id}/certificateBasedAuthConfiguration/{certificateBasedAuthConfiguration-id}.
 */
class MicrosoftEntraIdOrganizationDeleteCertificateBasedAuthConfiguration extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_organization_delete_certificate_based_auth_configuration';
    protected const DESCRIPTION = 'Delete certificateBasedAuthConfiguration\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /organization/{organization-id}/certificateBasedAuthConfiguration/{certificateBasedAuthConfiguration-id}.';
    protected const PARAMETERS = ['organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `organization-id`.'], 'certificate_based_auth_configuration_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `certificateBasedAuthConfiguration-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/organization/{organization-id}/certificateBasedAuthConfiguration/{certificateBasedAuthConfiguration-id}';
    protected const PATH_PARAMS = ['organization-id' => 'organization_id', 'certificateBasedAuthConfiguration-id' => 'certificate_based_auth_configuration_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

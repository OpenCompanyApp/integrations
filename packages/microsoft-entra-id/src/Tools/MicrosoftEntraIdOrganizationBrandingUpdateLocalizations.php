<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Update organizationalBrandingLocalization.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /organization/{organization-id}/branding/localizations/{organizationalBrandingLocalization-id}.
 */
class MicrosoftEntraIdOrganizationBrandingUpdateLocalizations extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_organization_branding_update_localizations';
    protected const DESCRIPTION = 'Update organizationalBrandingLocalization\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /organization/{organization-id}/branding/localizations/{organizationalBrandingLocalization-id}.';
    protected const PARAMETERS = ['organization_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `organization-id`.'], 'organizational_branding_localization_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `organizationalBrandingLocalization-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/organization/{organization-id}/branding/localizations/{organizationalBrandingLocalization-id}';
    protected const PATH_PARAMS = ['organization-id' => 'organization_id', 'organizationalBrandingLocalization-id' => 'organizational_branding_localization_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}

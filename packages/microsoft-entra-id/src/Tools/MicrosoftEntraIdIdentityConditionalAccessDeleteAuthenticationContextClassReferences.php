<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete authenticationContextClassReference.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /identity/conditionalAccess/authenticationContextClassReferences/{authenticationContextClassReference-id}.
 */
class MicrosoftEntraIdIdentityConditionalAccessDeleteAuthenticationContextClassReferences extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_conditional_access_delete_authentication_context_class_references';
    protected const DESCRIPTION = 'Delete authenticationContextClassReference\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /identity/conditionalAccess/authenticationContextClassReferences/{authenticationContextClassReference-id}.';
    protected const PARAMETERS = ['authentication_context_class_reference_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `authenticationContextClassReference-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/identity/conditionalAccess/authenticationContextClassReferences/{authenticationContextClassReference-id}';
    protected const PATH_PARAMS = ['authenticationContextClassReference-id' => 'authentication_context_class_reference_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

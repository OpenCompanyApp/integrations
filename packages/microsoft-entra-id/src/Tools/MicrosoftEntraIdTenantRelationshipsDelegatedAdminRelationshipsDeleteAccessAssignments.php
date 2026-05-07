<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete delegatedAdminAccessAssignment.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /tenantRelationships/delegatedAdminRelationships/{delegatedAdminRelationship-id}/accessAssignments/{delegatedAdminAccessAssignment-id}.
 */
class MicrosoftEntraIdTenantRelationshipsDelegatedAdminRelationshipsDeleteAccessAssignments extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_tenant_relationships_delegated_admin_relationships_delete_access_assignments';
    protected const DESCRIPTION = 'Delete delegatedAdminAccessAssignment\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /tenantRelationships/delegatedAdminRelationships/{delegatedAdminRelationship-id}/accessAssignments/{delegatedAdminAccessAssignment-id}.';
    protected const PARAMETERS = ['delegated_admin_relationship_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `delegatedAdminRelationship-id`.'], 'delegated_admin_access_assignment_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `delegatedAdminAccessAssignment-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/tenantRelationships/delegatedAdminRelationships/{delegatedAdminRelationship-id}/accessAssignments/{delegatedAdminAccessAssignment-id}';
    protected const PATH_PARAMS = ['delegatedAdminRelationship-id' => 'delegated_admin_relationship_id', 'delegatedAdminAccessAssignment-id' => 'delegated_admin_access_assignment_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke function filterOperators.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /servicePrincipals/{servicePrincipal-id}/synchronization/jobs/{synchronizationJob-id}/schema/filterOperators().
 */
class MicrosoftEntraIdServicePrincipalsServicePrincipalSynchronizationJobsSynchronizationJobSchemaFilterOperators extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_service_principals_service_principal_synchronization_jobs_synchronization_job_schema_filter_operators';
    protected const DESCRIPTION = 'Invoke function filterOperators\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /servicePrincipals/{servicePrincipal-id}/synchronization/jobs/{synchronizationJob-id}/schema/filterOperators().';
    protected const PARAMETERS = ['service_principal_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `servicePrincipal-id`.'], 'synchronization_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `synchronizationJob-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/servicePrincipals/{servicePrincipal-id}/synchronization/jobs/{synchronizationJob-id}/schema/filterOperators()';
    protected const PATH_PARAMS = ['servicePrincipal-id' => 'service_principal_id', 'synchronizationJob-id' => 'synchronization_job_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

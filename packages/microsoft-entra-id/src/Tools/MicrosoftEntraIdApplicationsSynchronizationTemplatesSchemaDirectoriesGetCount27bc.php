<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /applications/{application-id}/synchronization/templates/{synchronizationTemplate-id}/schema/directories/$count.
 */
class MicrosoftEntraIdApplicationsSynchronizationTemplatesSchemaDirectoriesGetCount27bc extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_applications_synchronization_templates_schema_directories_get_count_27bc';
    protected const DESCRIPTION = 'Get the number of the resource\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /applications/{application-id}/synchronization/templates/{synchronizationTemplate-id}/schema/directories/$count.';
    protected const PARAMETERS = ['application_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `application-id`.'], 'synchronization_template_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `synchronizationTemplate-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/applications/{application-id}/synchronization/templates/{synchronizationTemplate-id}/schema/directories/$count';
    protected const PATH_PARAMS = ['application-id' => 'application_id', 'synchronizationTemplate-id' => 'synchronization_template_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

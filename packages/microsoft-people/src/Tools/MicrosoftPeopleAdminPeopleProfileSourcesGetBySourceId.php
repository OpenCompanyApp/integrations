<?php

namespace OpenCompany\Integrations\MicrosoftPeople\Tools;

/**
 * Get profileSources from admin.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /admin/people/profileSources(sourceId='{sourceId}').
 */
class MicrosoftPeopleAdminPeopleProfileSourcesGetBySourceId extends AbstractMicrosoftPeopleTool
{
    protected const NAME = 'microsoft_people_admin_people_profile_sources_get_by_source_id';
    protected const DESCRIPTION = 'Get profileSources from admin\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /admin/people/profileSources(sourceId=\'{sourceId}\').';
    protected const PARAMETERS = ['source_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sourceId`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/admin/people/profileSources(sourceId=\'{sourceId}\')';
    protected const PATH_PARAMS = ['sourceId' => 'source_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}

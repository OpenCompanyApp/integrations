<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListTemplates.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/registry/templates.
 */
class PulumiRegistryPreviewListTemplatesPreview extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_registry_preview_list_templates_preview';
    protected const DESCRIPTION = 'ListTemplates

Official Pulumi Cloud endpoint: GET /api/preview/registry/templates

Lists registry-backed templates with optional filtering, search, and pagination. This endpoint returns only registry-backed templates and does not include VCS-backed templates (those sourced from GitHub or GitLab repositories). No authentication is required. Results can be filtered by template name and owning organization (orgLogin). The search parameter performs case-insensitive partial matching against the template name, display name, description, metadata values, and runtime language. Results are paginated with a default limit of 100 per page; use the continuationToken from the response to retrieve subsequent pages. Each entry in the response includes the template\'s name, publisher, source, display name, description, runtime, language, readme URL, download URL, visibility, and updated timestamp.';
    protected const PARAMETERS = array (
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Pagination token for retrieving the next page of results',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Pulumi Cloud API operation. Maximum number of results to return (default: 100)',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Pulumi Cloud API operation. Filter by specific template name',
  ),
  'org_login' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `orgLogin` from the official Pulumi Cloud API operation. Filter by owning organization',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `search` from the official Pulumi Cloud API operation. Search query matching template name, display name, description, metadata values, or runtime language. Multiple space-separated terms requ...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/registry/templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'limit' => 'limit',
  'name' => 'name',
  'orgLogin' => 'org_login',
  'search' => 'search',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Sections.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/charts/section.
 */
class LangSmithReadSections extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_sections';
    protected const DESCRIPTION = 'Read Sections

Official endpoint: GET /api/v1/charts/section
Get all sections for the tenant.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, offset, title_contains, ids, sort_by, sort_by_desc, tag_value_id.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'title_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `title_contains`.',
  ),
  'ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `ids`.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
  'sort_by_desc' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_desc`.',
  ),
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/charts/section';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'offset',
  2 => 'title_contains',
  3 => 'ids',
  4 => 'sort_by',
  5 => 'sort_by_desc',
  6 => 'tag_value_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

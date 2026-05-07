<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List Confluence spaces.
 *
 * Maps to the official FireHydrant endpoint get /v1/integrations/confluence_cloud/connections/{id}/space/search.
 */
class FireHydrantSearchConfluenceSpaces extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_search_confluence_spaces';
    protected const DESCRIPTION = 'List Confluence spaces

Official FireHydrant endpoint: GET /v1/integrations/confluence_cloud/connections/{id}/space/search

Lists available space keys for the Confluence integration connection.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'keyword' =>
  array (
    'type' => 'string',
    'description' => 'Space Key (Deprecated)',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Space name query',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/integrations/confluence_cloud/connections/{id}/space/search';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'keyword' => 'keyword',
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

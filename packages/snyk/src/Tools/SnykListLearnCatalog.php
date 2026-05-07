<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Snyk Learn's resources (Early Access).
 *
 * Maps to the official Snyk endpoint get /learn/catalog.
 */
class SnykListLearnCatalog extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_learn_catalog';
    protected const DESCRIPTION = 'List Snyk Learn\'s resources (Early Access)

Official Snyk endpoint: GET /learn/catalog

List Snyk Learn\'s catalog resources';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'content_source' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `content_source` from the official Snyk API operation. The source of educational resources',
    'enum' =>
    array (
      0 => 'source-preview',
      1 => 'cache',
    ),
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/learn/catalog';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'content_source' => 'content_source',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List changes.
 *
 * Maps to the official FireHydrant endpoint get /v1/changes.
 */
class FireHydrantListChanges extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_changes';
    protected const DESCRIPTION = 'List changes

Official FireHydrant endpoint: GET /v1/changes

List changes for the organization';
    protected const PARAMETERS = array (
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
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Filter changes by summary',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/changes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

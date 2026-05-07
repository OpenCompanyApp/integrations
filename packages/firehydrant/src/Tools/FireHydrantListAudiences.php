<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List audiences.
 *
 * Maps to the official FireHydrant endpoint get /v1/audiences.
 */
class FireHydrantListAudiences extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_audiences';
    protected const DESCRIPTION = 'List audiences

Official FireHydrant endpoint: GET /v1/audiences

List all audiences';
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
  'include_archived' =>
  array (
    'type' => 'boolean',
    'description' => 'Include archived (discarded) audiences',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/audiences';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'include_archived' => 'include_archived',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

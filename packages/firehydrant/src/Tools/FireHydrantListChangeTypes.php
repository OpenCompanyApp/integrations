<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List change types.
 *
 * Maps to the official FireHydrant endpoint get /v1/change_types.
 */
class FireHydrantListChangeTypes extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_change_types';
    protected const DESCRIPTION = 'List change types

Official FireHydrant endpoint: GET /v1/change_types

List change types for the organization';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/change_types';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

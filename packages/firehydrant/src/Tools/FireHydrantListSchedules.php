<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List schedules.
 *
 * Maps to the official FireHydrant endpoint get /v1/schedules.
 */
class FireHydrantListSchedules extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_schedules';
    protected const DESCRIPTION = 'List schedules

Official FireHydrant endpoint: GET /v1/schedules

List all known schedules in FireHydrant as pulled from external sources';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Filter schedules with a query on their name',
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
    protected const PATH = '/v1/schedules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List functionalities.
 *
 * Maps to the official FireHydrant endpoint get /v1/functionalities.
 */
class FireHydrantListFunctionalities extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_functionalities';
    protected const DESCRIPTION = 'List functionalities

Official FireHydrant endpoint: GET /v1/functionalities

List all of the functionalities that have been added to the organiation';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search functionalities by their name or description',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'A query to search functionalities by their name',
  ),
  'impacted' =>
  array (
    'type' => 'string',
    'description' => 'A query to search services by if they are impacted with active incidents',
  ),
  'labels' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of label key / values in the format of \'key=value,key2=value2\'. To filter change events that have a key (with no specific value), omit the value',
  ),
  'owner' =>
  array (
    'type' => 'string',
    'description' => 'A query to search functionalities by their owning team ID',
  ),
  'lite' =>
  array (
    'type' => 'boolean',
    'description' => 'Boolean to determine whether to return a slimified version of the functionalities object',
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
    protected const PATH = '/v1/functionalities';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'name' => 'name',
  'impacted' => 'impacted',
  'labels' => 'labels',
  'owner' => 'owner',
  'lite' => 'lite',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

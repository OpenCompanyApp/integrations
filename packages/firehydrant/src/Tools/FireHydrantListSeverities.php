<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List severities.
 *
 * Maps to the official FireHydrant endpoint get /v1/severities.
 */
class FireHydrantListSeverities extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_severities';
    protected const DESCRIPTION = 'List severities

Official FireHydrant endpoint: GET /v1/severities

Lists severities';
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
    protected const PATH = '/v1/severities';
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

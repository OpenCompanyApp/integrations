<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List scheduled maintenance events.
 *
 * Maps to the official FireHydrant endpoint get /v1/scheduled_maintenances.
 */
class FireHydrantListScheduledMaintenances extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_scheduled_maintenances';
    protected const DESCRIPTION = 'List scheduled maintenance events

Official FireHydrant endpoint: GET /v1/scheduled_maintenances

Lists all scheduled maintenance events';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'Filter scheduled_maintenances with a query on their name',
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
    protected const PATH = '/v1/scheduled_maintenances';
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

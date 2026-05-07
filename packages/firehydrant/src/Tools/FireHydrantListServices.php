<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List services.
 *
 * Maps to the official FireHydrant endpoint get /v1/services.
 */
class FireHydrantListServices extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_services';
    protected const DESCRIPTION = 'List services

Official FireHydrant endpoint: GET /v1/services

List all of the services that have been added to the organization.';
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
  'labels' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of label key / values in the format of \'key=value,key2=value2\'. To filter change events that have a key (with no specific value), omit the value',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search services by their name or description',
  ),
  'name' =>
  array (
    'type' => 'string',
    'description' => 'A query to search services by their name',
  ),
  'tiers' =>
  array (
    'type' => 'string',
    'description' => 'A query to search services by their tier',
  ),
  'impacted' =>
  array (
    'type' => 'string',
    'description' => 'A query to search services by if they are impacted with active incidents',
  ),
  'owner' =>
  array (
    'type' => 'string',
    'description' => 'A query to search services by their owner',
  ),
  'responding_teams' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of team ids',
  ),
  'functionalities' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of functionality ids',
  ),
  'available_downstream_dependencies_for_id' =>
  array (
    'type' => 'string',
    'description' => 'A query to find services that are available to be downstream dependencies for the passed service ID',
  ),
  'available_upstream_dependencies_for_id' =>
  array (
    'type' => 'string',
    'description' => 'A query to find services that are available to be upstream dependencies for the passed service ID',
  ),
  'lite' =>
  array (
    'type' => 'boolean',
    'description' => 'Boolean to determine whether to return a slimified version of the services object',
  ),
  'include' =>
  array (
    'type' => 'array',
    'description' => 'Use in conjunction with lite param to specify additional attributes to include',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/services';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'labels' => 'labels',
  'query' => 'query',
  'name' => 'name',
  'tiers' => 'tiers',
  'impacted' => 'impacted',
  'owner' => 'owner',
  'responding_teams' => 'responding_teams',
  'functionalities' => 'functionalities',
  'available_downstream_dependencies_for_id' => 'available_downstream_dependencies_for_id',
  'available_upstream_dependencies_for_id' => 'available_upstream_dependencies_for_id',
  'lite' => 'lite',
  'include' => 'include',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

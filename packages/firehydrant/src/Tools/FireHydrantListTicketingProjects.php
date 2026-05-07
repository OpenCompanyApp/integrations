<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List ticketing projects.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/projects.
 */
class FireHydrantListTicketingProjects extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_ticketing_projects';
    protected const DESCRIPTION = 'List ticketing projects

Official FireHydrant endpoint: GET /v1/ticketing/projects

List all ticketing projects available to the organization';
    protected const PARAMETERS = array (
  'supports_ticket_types' =>
  array (
    'type' => 'string',
    'description' => 'supports_ticket_types parameter.',
  ),
  'providers' =>
  array (
    'type' => 'string',
    'description' => 'providers parameter.',
  ),
  'connection_ids' =>
  array (
    'type' => 'string',
    'description' => 'connection_ids parameter.',
  ),
  'configured_projects' =>
  array (
    'type' => 'boolean',
    'description' => 'configured_projects parameter.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'query parameter.',
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
    protected const PATH = '/v1/ticketing/projects';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'supports_ticket_types' => 'supports_ticket_types',
  'providers' => 'providers',
  'connection_ids' => 'connection_ids',
  'configured_projects' => 'configured_projects',
  'query' => 'query',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

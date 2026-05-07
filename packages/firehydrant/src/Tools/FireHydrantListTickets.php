<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List tickets.
 *
 * Maps to the official FireHydrant endpoint get /v1/ticketing/tickets.
 */
class FireHydrantListTickets extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_tickets';
    protected const DESCRIPTION = 'List tickets

Official FireHydrant endpoint: GET /v1/ticketing/tickets

List all of the tickets that have been added to the organiation';
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
  'tags' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of tags',
  ),
  'tag_match_strategy' =>
  array (
    'type' => 'string',
    'description' => 'A matching strategy for the tags provided',
    'enum' =>
    array (
      0 => 'any',
      1 => 'match_all',
      2 => 'exclude',
    ),
  ),
  'assigned_user' =>
  array (
    'type' => 'string',
    'description' => 'Filter tickets assigned to this user id',
  ),
  'state' =>
  array (
    'type' => 'string',
    'description' => 'Filter tickets by state',
    'enum' =>
    array (
      0 => 'open',
      1 => 'in_progress',
      2 => 'cancelled',
      3 => 'done',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/ticketing/tickets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'tags' => 'tags',
  'tag_match_strategy' => 'tag_match_strategy',
  'assigned_user' => 'assigned_user',
  'state' => 'state',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

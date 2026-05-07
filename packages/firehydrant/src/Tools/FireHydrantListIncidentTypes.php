<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident types.
 *
 * Maps to the official FireHydrant endpoint get /v1/incident_types.
 */
class FireHydrantListIncidentTypes extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_types';
    protected const DESCRIPTION = 'List incident types

Official FireHydrant endpoint: GET /v1/incident_types

List all of the incident types in the organization';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search incident types by their name',
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
    protected const PATH = '/v1/incident_types';
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

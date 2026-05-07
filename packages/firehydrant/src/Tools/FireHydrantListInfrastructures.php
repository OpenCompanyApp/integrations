<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Lists functionality, service and environment objects.
 *
 * Maps to the official FireHydrant endpoint get /v1/infrastructures.
 */
class FireHydrantListInfrastructures extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_infrastructures';
    protected const DESCRIPTION = 'Lists functionality, service and environment objects

Official FireHydrant endpoint: GET /v1/infrastructures

Lists functionality, service and environment objects';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query to search infrastructures by their name',
  ),
  'omit_for' =>
  array (
    'type' => 'string',
    'description' => 'Omit for any infrastructure that is added to an incident using the format "incident/{incident_id}"',
  ),
  'type' =>
  array (
    'type' => 'string',
    'description' => 'Restrict infrastructure search to given type.',
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
    protected const PATH = '/v1/infrastructures';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
  'omit_for' => 'omit_for',
  'type' => 'type',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List similar incidents.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/similar.
 */
class FireHydrantListSimilarIncidents extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_similar_incidents';
    protected const DESCRIPTION = 'List similar incidents

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/similar

Retrieve a list of similar incidents';
    protected const PARAMETERS = array (
  'threshold' =>
  array (
    'type' => 'number',
    'description' => 'threshold parameter.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'limit parameter.',
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/similar';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'threshold' => 'threshold',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

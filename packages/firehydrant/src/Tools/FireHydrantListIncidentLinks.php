<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List links on an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/links.
 */
class FireHydrantListIncidentLinks extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_links';
    protected const DESCRIPTION = 'List links on an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/links

List all the editable, external incident links attached to an incident';
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
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/links';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

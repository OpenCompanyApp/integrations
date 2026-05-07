<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Add a status page to an incident.
 *
 * Maps to the official FireHydrant endpoint post /v1/incidents/{incident_id}/status_pages.
 */
class FireHydrantCreateIncidentStatusPage extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_incident_status_page';
    protected const DESCRIPTION = 'Add a status page to an incident

Official FireHydrant endpoint: POST /v1/incidents/{incident_id}/status_pages

Add a status page to an incident.';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/status_pages';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Attach alerts to an incident.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{incident_id}/alerts.
 */
class RootlyAttachAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_attach_alert';
    protected const DESCRIPTION = 'Attach alerts to an incident

Official Rootly endpoint: POST /v1/incidents/{incident_id}/alerts

Attach alerts to an incident from provided data';
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
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{incident_id}/alerts';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

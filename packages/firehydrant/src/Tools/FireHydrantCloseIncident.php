<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Close an incident.
 *
 * Maps to the official FireHydrant endpoint put /v1/incidents/{incident_id}/close.
 */
class FireHydrantCloseIncident extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_close_incident';
    protected const DESCRIPTION = 'Close an incident

Official FireHydrant endpoint: PUT /v1/incidents/{incident_id}/close

Closes an incident and optionally close all children';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incidents/{incident_id}/close';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

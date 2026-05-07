<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Remove a link from an incident.
 *
 * Maps to the official FireHydrant endpoint delete /v1/incidents/{incident_id}/links/{link_id}.
 */
class FireHydrantDeleteIncidentLink extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_incident_link';
    protected const DESCRIPTION = 'Remove a link from an incident

Official FireHydrant endpoint: DELETE /v1/incidents/{incident_id}/links/{link_id}

Remove a link from an incident';
    protected const PARAMETERS = array (
  'link_id' =>
  array (
    'type' => 'string',
    'description' => 'link_id parameter.',
    'required' => true,
  ),
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{incident_id}/links/{link_id}';
    protected const PATH_PARAMS = array (
  'link_id' => 'link_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

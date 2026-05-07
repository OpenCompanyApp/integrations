<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update the external incident link.
 *
 * Maps to the official FireHydrant endpoint put /v1/incidents/{incident_id}/links/{link_id}.
 */
class FireHydrantUpdateIncidentLink extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_incident_link';
    protected const DESCRIPTION = 'Update the external incident link

Official FireHydrant endpoint: PUT /v1/incidents/{incident_id}/links/{link_id}

Update the external incident link attributes';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/incidents/{incident_id}/links/{link_id}';
    protected const PATH_PARAMS = array (
  'link_id' => 'link_id',
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

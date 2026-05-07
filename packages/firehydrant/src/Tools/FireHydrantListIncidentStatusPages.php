<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List status pages for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/status_pages.
 */
class FireHydrantListIncidentStatusPages extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_status_pages';
    protected const DESCRIPTION = 'List status pages for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/status_pages

List status pages that are attached to an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/status_pages';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

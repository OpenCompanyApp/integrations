<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List attachments for an incident.
 *
 * Maps to the official FireHydrant endpoint get /v1/incidents/{incident_id}/attachments.
 */
class FireHydrantListIncidentAttachments extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_attachments';
    protected const DESCRIPTION = 'List attachments for an incident

Official FireHydrant endpoint: GET /v1/incidents/{incident_id}/attachments

List attachments for an incident';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'attachable_type' =>
  array (
    'type' => 'string',
    'description' => 'attachable_type parameter.',
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
    protected const PATH = '/v1/incidents/{incident_id}/attachments';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'attachable_type' => 'attachable_type',
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

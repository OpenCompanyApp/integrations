<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident feedbacks.
 *
 * Maps to the official Rootly endpoint get /v1/incidents/{incident_id}/feedbacks.
 */
class RootlyListIncidentFeedbacks extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_feedbacks';
    protected const DESCRIPTION = 'List incident feedbacks

Official Rootly endpoint: GET /v1/incidents/{incident_id}/feedbacks

List incident feedbacks';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/feedbacks';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

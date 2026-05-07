<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an incident feedback.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{incident_id}/feedbacks.
 */
class RootlyCreateIncidentFeedback extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_incident_feedback';
    protected const DESCRIPTION = 'Creates an incident feedback

Official Rootly endpoint: POST /v1/incidents/{incident_id}/feedbacks

Creates a new feedback from provided data';
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
    protected const PATH = '/v1/incidents/{incident_id}/feedbacks';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

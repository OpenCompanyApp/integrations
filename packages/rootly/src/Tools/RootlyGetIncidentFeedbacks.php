<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident feedback.
 *
 * Maps to the official Rootly endpoint get /v1/feedbacks/{id}.
 */
class RootlyGetIncidentFeedbacks extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_feedbacks';
    protected const DESCRIPTION = 'Retrieves an incident feedback

Official Rootly endpoint: GET /v1/feedbacks/{id}

Retrieves a specific incident_feedback by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/feedbacks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident feedback.
 *
 * Maps to the official Rootly endpoint put /v1/feedbacks/{id}.
 */
class RootlyUpdateIncidentFeedback extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_feedback';
    protected const DESCRIPTION = 'Update an incident feedback

Official Rootly endpoint: PUT /v1/feedbacks/{id}

Update a specific incident feedback by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/feedbacks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

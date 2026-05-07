<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Mark an incident as a duplicate.
 *
 * Maps to the official Rootly endpoint put /v1/incidents/{id}/duplicate.
 */
class RootlyMarkAsDuplicateIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_mark_as_duplicate_incident';
    protected const DESCRIPTION = 'Mark an incident as a duplicate

Official Rootly endpoint: PUT /v1/incidents/{id}/duplicate

Mark an incident as a duplicate';
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
    protected const PATH = '/v1/incidents/{id}/duplicate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

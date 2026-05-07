<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Add subscribers to incident.
 *
 * Maps to the official Rootly endpoint post /v1/incidents/{id}/add_subscribers.
 */
class RootlyAddSubscribersToIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_add_subscribers_to_incident';
    protected const DESCRIPTION = 'Add subscribers to incident

Official Rootly endpoint: POST /v1/incidents/{id}/add_subscribers

Add subscribers to incident';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/incidents/{id}/add_subscribers';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

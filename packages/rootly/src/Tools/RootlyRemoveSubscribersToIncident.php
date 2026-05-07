<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Remove subscribers from incident.
 *
 * Maps to the official Rootly endpoint delete /v1/incidents/{id}/remove_subscribers.
 */
class RootlyRemoveSubscribersToIncident extends AbstractRootlyTool
{
    protected const NAME = 'rootly_remove_subscribers_to_incident';
    protected const DESCRIPTION = 'Remove subscribers from incident

Official Rootly endpoint: DELETE /v1/incidents/{id}/remove_subscribers

Remove subscribers to incident';
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
    protected const METHOD = 'delete';
    protected const PATH = '/v1/incidents/{id}/remove_subscribers';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

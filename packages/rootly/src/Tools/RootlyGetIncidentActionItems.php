<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an incident action item.
 *
 * Maps to the official Rootly endpoint get /v1/action_items/{id}.
 */
class RootlyGetIncidentActionItems extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_incident_action_items';
    protected const DESCRIPTION = 'Retrieves an incident action item

Official Rootly endpoint: GET /v1/action_items/{id}

Retrieves a specific incident_action_item by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/action_items/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

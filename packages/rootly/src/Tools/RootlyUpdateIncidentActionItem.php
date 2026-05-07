<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an incident action item.
 *
 * Maps to the official Rootly endpoint put /v1/action_items/{id}.
 */
class RootlyUpdateIncidentActionItem extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_incident_action_item';
    protected const DESCRIPTION = 'Update an incident action item

Official Rootly endpoint: PUT /v1/action_items/{id}

Update a specific incident action item by id';
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
    protected const PATH = '/v1/action_items/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

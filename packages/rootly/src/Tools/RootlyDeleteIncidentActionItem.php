<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete an incident action item.
 *
 * Maps to the official Rootly endpoint delete /v1/action_items/{id}.
 */
class RootlyDeleteIncidentActionItem extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_incident_action_item';
    protected const DESCRIPTION = 'Delete an incident action item

Official Rootly endpoint: DELETE /v1/action_items/{id}

Delete a specific incident action item by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

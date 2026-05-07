<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a change event.
 *
 * Maps to the official FireHydrant endpoint delete /v1/changes/events/{change_event_id}.
 */
class FireHydrantDeleteChangeEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_change_event';
    protected const DESCRIPTION = 'Delete a change event

Official FireHydrant endpoint: DELETE /v1/changes/events/{change_event_id}

Delete a change event';
    protected const PARAMETERS = array (
  'change_event_id' =>
  array (
    'type' => 'string',
    'description' => 'change_event_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/changes/events/{change_event_id}';
    protected const PATH_PARAMS = array (
  'change_event_id' => 'change_event_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a change event.
 *
 * Maps to the official FireHydrant endpoint patch /v1/changes/events/{change_event_id}.
 */
class FireHydrantUpdateChangeEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_change_event';
    protected const DESCRIPTION = 'Update a change event

Official FireHydrant endpoint: PATCH /v1/changes/events/{change_event_id}

Update a change event';
    protected const PARAMETERS = array (
  'change_event_id' =>
  array (
    'type' => 'string',
    'description' => 'change_event_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/changes/events/{change_event_id}';
    protected const PATH_PARAMS = array (
  'change_event_id' => 'change_event_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

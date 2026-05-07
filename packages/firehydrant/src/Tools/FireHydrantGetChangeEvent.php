<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a change event.
 *
 * Maps to the official FireHydrant endpoint get /v1/changes/events/{change_event_id}.
 */
class FireHydrantGetChangeEvent extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_change_event';
    protected const DESCRIPTION = 'Get a change event

Official FireHydrant endpoint: GET /v1/changes/events/{change_event_id}

Retrieve a change event';
    protected const PARAMETERS = array (
  'change_event_id' =>
  array (
    'type' => 'string',
    'description' => 'change_event_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

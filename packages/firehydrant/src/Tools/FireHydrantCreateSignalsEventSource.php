<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an event source for Signals.
 *
 * Maps to the official FireHydrant endpoint put /v1/signals/event_sources.
 */
class FireHydrantCreateSignalsEventSource extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_signals_event_source';
    protected const DESCRIPTION = 'Create an event source for Signals

Official FireHydrant endpoint: PUT /v1/signals/event_sources

Create a Signals event source for the authenticated user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/signals/event_sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

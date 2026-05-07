<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an event source for Signals.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/event_sources/{transposer_slug}.
 */
class FireHydrantGetSignalsEventSource extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_event_source';
    protected const DESCRIPTION = 'Get an event source for Signals

Official FireHydrant endpoint: GET /v1/signals/event_sources/{transposer_slug}

Get a Signals event source by slug';
    protected const PARAMETERS = array (
  'transposer_slug' =>
  array (
    'type' => 'string',
    'description' => 'transposer_slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/event_sources/{transposer_slug}';
    protected const PATH_PARAMS = array (
  'transposer_slug' => 'transposer_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

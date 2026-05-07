<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an event source for Signals.
 *
 * Maps to the official FireHydrant endpoint delete /v1/signals/event_sources/{transposer_slug}.
 */
class FireHydrantDeleteSignalsEventSource extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_signals_event_source';
    protected const DESCRIPTION = 'Delete an event source for Signals

Official FireHydrant endpoint: DELETE /v1/signals/event_sources/{transposer_slug}

Delete a Signals event source by slug';
    protected const PARAMETERS = array (
  'transposer_slug' =>
  array (
    'type' => 'string',
    'description' => 'transposer_slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

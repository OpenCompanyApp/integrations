<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single event.
 *
 * Maps to the official GoCardless endpoint GET /events/{event_id}.
 */
class GoCardlessGetEvents extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_events';
    protected const DESCRIPTION = 'Retrieves the details of a single event.

Official GoCardless endpoint: GET /events/{event_id}.';
    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The event id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/events/{event_id}';
    protected const PATH_PARAMS = [
        'event_id' => 'event_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}

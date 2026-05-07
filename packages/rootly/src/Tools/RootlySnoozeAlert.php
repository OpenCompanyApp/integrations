<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Snoozes an alert.
 *
 * Maps to the official Rootly endpoint post /v1/alerts/{id}/snooze.
 */
class RootlySnoozeAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_snooze_alert';
    protected const DESCRIPTION = 'Snoozes an alert

Official Rootly endpoint: POST /v1/alerts/{id}/snooze

Snoozes a specific alert by id, extending the acknowledgment timeout';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/alerts/{id}/snooze';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

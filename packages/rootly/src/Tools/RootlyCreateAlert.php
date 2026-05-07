<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert.
 *
 * Maps to the official Rootly endpoint post /v1/alerts.
 */
class RootlyCreateAlert extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert';
    protected const DESCRIPTION = 'Creates an alert

Official Rootly endpoint: POST /v1/alerts

Creates a new alert from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alerts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert source.
 *
 * Maps to the official Rootly endpoint post /v1/alert_sources.
 */
class RootlyCreateAlertsSource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alerts_source';
    protected const DESCRIPTION = 'Creates an alert source

Official Rootly endpoint: POST /v1/alert_sources

Creates a new alert source from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alert_sources';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

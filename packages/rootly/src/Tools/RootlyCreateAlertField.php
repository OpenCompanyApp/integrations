<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an alert field.
 *
 * Maps to the official Rootly endpoint post /v1/alert_fields.
 */
class RootlyCreateAlertField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_alert_field';
    protected const DESCRIPTION = 'Creates an alert field

Official Rootly endpoint: POST /v1/alert_fields

Creates a new alert field from provided data';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/alert_fields';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

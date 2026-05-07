<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an alert field.
 *
 * Maps to the official Rootly endpoint put /v1/alert_fields/{id}.
 */
class RootlyUpdateAlertField extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alert_field';
    protected const DESCRIPTION = 'Update an alert field

Official Rootly endpoint: PUT /v1/alert_fields/{id}

Update a specific alert field by id';
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
    protected const METHOD = 'put';
    protected const PATH = '/v1/alert_fields/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

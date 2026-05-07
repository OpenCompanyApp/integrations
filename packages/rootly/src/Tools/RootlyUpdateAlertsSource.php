<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Update an alert source.
 *
 * Maps to the official Rootly endpoint put /v1/alert_sources/{id}.
 */
class RootlyUpdateAlertsSource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_update_alerts_source';
    protected const DESCRIPTION = 'Update an alert source

Official Rootly endpoint: PUT /v1/alert_sources/{id}

Update a specific alert source by id';
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
    protected const PATH = '/v1/alert_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves an alert source.
 *
 * Maps to the official Rootly endpoint get /v1/alert_sources/{id}.
 */
class RootlyGetAlertsSource extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_alerts_source';
    protected const DESCRIPTION = 'Retrieves an alert source

Official Rootly endpoint: GET /v1/alert_sources/{id}

Retrieves a specific alert source by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_sources/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

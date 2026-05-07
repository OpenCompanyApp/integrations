<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an alert.
 *
 * Maps to the official FireHydrant endpoint get /v1/alerts/{alert_id}.
 */
class FireHydrantGetAlert extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_alert';
    protected const DESCRIPTION = 'Get an alert

Official FireHydrant endpoint: GET /v1/alerts/{alert_id}

Retrieve a single alert';
    protected const PARAMETERS = array (
  'alert_id' =>
  array (
    'type' => 'string',
    'description' => 'alert_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alerts/{alert_id}';
    protected const PATH_PARAMS = array (
  'alert_id' => 'alert_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

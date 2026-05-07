<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get an alert grouping configuration..
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/grouping/{id}.
 */
class FireHydrantGetSignalsAlertGroupingConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_alert_grouping_configuration';
    protected const DESCRIPTION = 'Get an alert grouping configuration.

Official FireHydrant endpoint: GET /v1/signals/grouping/{id}

Get a Signals alert grouping rule by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/grouping/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an alert grouping configuration..
 *
 * Maps to the official FireHydrant endpoint post /v1/signals/grouping.
 */
class FireHydrantCreateSignalsAlertGroupingConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_signals_alert_grouping_configuration';
    protected const DESCRIPTION = 'Create an alert grouping configuration.

Official FireHydrant endpoint: POST /v1/signals/grouping

Create a Signals alert grouping rule for the organization.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/signals/grouping';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

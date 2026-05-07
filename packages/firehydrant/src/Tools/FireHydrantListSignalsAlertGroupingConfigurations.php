<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List alert grouping configurations..
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/grouping.
 */
class FireHydrantListSignalsAlertGroupingConfigurations extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_signals_alert_grouping_configurations';
    protected const DESCRIPTION = 'List alert grouping configurations.

Official FireHydrant endpoint: GET /v1/signals/grouping

List all Signals alert grouping rules for the organization.';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/grouping';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

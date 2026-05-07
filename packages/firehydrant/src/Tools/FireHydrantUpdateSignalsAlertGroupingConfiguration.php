<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an alert grouping configuration..
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/grouping/{id}.
 */
class FireHydrantUpdateSignalsAlertGroupingConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_signals_alert_grouping_configuration';
    protected const DESCRIPTION = 'Update an alert grouping configuration.

Official FireHydrant endpoint: PATCH /v1/signals/grouping/{id}

Update a Signals alert grouping rule for the organization.';
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
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/signals/grouping/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

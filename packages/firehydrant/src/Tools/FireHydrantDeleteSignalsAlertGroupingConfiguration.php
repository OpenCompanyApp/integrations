<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an alert grouping configuration..
 *
 * Maps to the official FireHydrant endpoint delete /v1/signals/grouping/{id}.
 */
class FireHydrantDeleteSignalsAlertGroupingConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_signals_alert_grouping_configuration';
    protected const DESCRIPTION = 'Delete an alert grouping configuration.

Official FireHydrant endpoint: DELETE /v1/signals/grouping/{id}

Delete a Signals alert grouping rule by ID.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

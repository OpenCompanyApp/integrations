<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List email targets for signals.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/email_targets.
 */
class FireHydrantListSignalsEmailTargets extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_signals_email_targets';
    protected const DESCRIPTION = 'List email targets for signals

Official FireHydrant endpoint: GET /v1/signals/email_targets

List all Signals email targets for a team.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A query string to search the list of targets by.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/email_targets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a signal email target.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/email_targets/{id}.
 */
class FireHydrantGetSignalsEmailTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_email_target';
    protected const DESCRIPTION = 'Get a signal email target

Official FireHydrant endpoint: GET /v1/signals/email_targets/{id}

Get a Signals email target by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/email_targets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a Signal alert.
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/alerts/{id}.
 */
class FireHydrantUpdateSignalsAlert extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_signals_alert';
    protected const DESCRIPTION = 'Update a Signal alert

Official FireHydrant endpoint: PATCH /v1/signals/alerts/{id}

Update a Signal alert';
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
    protected const PATH = '/v1/signals/alerts/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

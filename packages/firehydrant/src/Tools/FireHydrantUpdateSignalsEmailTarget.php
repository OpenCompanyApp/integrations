<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an email target.
 *
 * Maps to the official FireHydrant endpoint patch /v1/signals/email_targets/{id}.
 */
class FireHydrantUpdateSignalsEmailTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_signals_email_target';
    protected const DESCRIPTION = 'Update an email target

Official FireHydrant endpoint: PATCH /v1/signals/email_targets/{id}

Update a Signals email target by ID';
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
    protected const PATH = '/v1/signals/email_targets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

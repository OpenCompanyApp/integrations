<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an email target for signals.
 *
 * Maps to the official FireHydrant endpoint post /v1/signals/email_targets.
 */
class FireHydrantCreateSignalsEmailTarget extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_signals_email_target';
    protected const DESCRIPTION = 'Create an email target for signals

Official FireHydrant endpoint: POST /v1/signals/email_targets

Create a Signals email target for a team.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/signals/email_targets';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

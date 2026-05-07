<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Debug Signals expressions.
 *
 * Maps to the official FireHydrant endpoint post /v1/signals/debugger.
 */
class FireHydrantDebugSignalsExpression extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_debug_signals_expression';
    protected const DESCRIPTION = 'Debug Signals expressions

Official FireHydrant endpoint: POST /v1/signals/debugger

Debug Signals expressions';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/signals/debugger';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

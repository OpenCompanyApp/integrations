<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a runbook.
 *
 * Maps to the official FireHydrant endpoint get /v1/runbooks/{runbook_id}.
 */
class FireHydrantGetRunbook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_runbook';
    protected const DESCRIPTION = 'Get a runbook

Official FireHydrant endpoint: GET /v1/runbooks/{runbook_id}

Get a runbook and all its configuration';
    protected const PARAMETERS = array (
  'runbook_id' =>
  array (
    'type' => 'string',
    'description' => 'runbook_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/runbooks/{runbook_id}';
    protected const PATH_PARAMS = array (
  'runbook_id' => 'runbook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

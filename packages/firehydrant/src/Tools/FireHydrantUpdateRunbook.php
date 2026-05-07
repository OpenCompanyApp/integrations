<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a runbook.
 *
 * Maps to the official FireHydrant endpoint put /v1/runbooks/{runbook_id}.
 */
class FireHydrantUpdateRunbook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_runbook';
    protected const DESCRIPTION = 'Update a runbook

Official FireHydrant endpoint: PUT /v1/runbooks/{runbook_id}

Update a runbook and any attachment rules associated with it. This endpoint is used to configure nearly everything
about a runbook, including but not limited to the steps, environments, attachment rules, and severities.';
    protected const PARAMETERS = array (
  'runbook_id' =>
  array (
    'type' => 'string',
    'description' => 'runbook_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/runbooks/{runbook_id}';
    protected const PATH_PARAMS = array (
  'runbook_id' => 'runbook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

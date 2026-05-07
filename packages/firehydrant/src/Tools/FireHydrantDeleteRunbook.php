<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a runbook.
 *
 * Maps to the official FireHydrant endpoint delete /v1/runbooks/{runbook_id}.
 */
class FireHydrantDeleteRunbook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_runbook';
    protected const DESCRIPTION = 'Delete a runbook

Official FireHydrant endpoint: DELETE /v1/runbooks/{runbook_id}

Delete a runbook and make it unavailable for any future incidents.';
    protected const PARAMETERS = array (
  'runbook_id' =>
  array (
    'type' => 'string',
    'description' => 'runbook_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

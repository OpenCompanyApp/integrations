<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a runbook.
 *
 * Maps to the official FireHydrant endpoint post /v1/runbooks.
 */
class FireHydrantCreateRunbook extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_runbook';
    protected const DESCRIPTION = 'Create a runbook

Official FireHydrant endpoint: POST /v1/runbooks

Create a new runbook for use with incidents.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/runbooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

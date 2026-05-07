<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a severity.
 *
 * Maps to the official FireHydrant endpoint patch /v1/severities/{severity_slug}.
 */
class FireHydrantUpdateSeverity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_severity';
    protected const DESCRIPTION = 'Update a severity

Official FireHydrant endpoint: PATCH /v1/severities/{severity_slug}

Update a specific severity';
    protected const PARAMETERS = array (
  'severity_slug' =>
  array (
    'type' => 'string',
    'description' => 'severity_slug parameter.',
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
    protected const PATH = '/v1/severities/{severity_slug}';
    protected const PATH_PARAMS = array (
  'severity_slug' => 'severity_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

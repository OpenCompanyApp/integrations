<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a severity.
 *
 * Maps to the official FireHydrant endpoint get /v1/severities/{severity_slug}.
 */
class FireHydrantGetSeverity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_severity';
    protected const DESCRIPTION = 'Get a severity

Official FireHydrant endpoint: GET /v1/severities/{severity_slug}

Retrieve a specific severity';
    protected const PARAMETERS = array (
  'severity_slug' =>
  array (
    'type' => 'string',
    'description' => 'severity_slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/severities/{severity_slug}';
    protected const PATH_PARAMS = array (
  'severity_slug' => 'severity_slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

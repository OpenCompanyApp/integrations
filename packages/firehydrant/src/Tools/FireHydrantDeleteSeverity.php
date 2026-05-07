<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a severity.
 *
 * Maps to the official FireHydrant endpoint delete /v1/severities/{severity_slug}.
 */
class FireHydrantDeleteSeverity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_severity';
    protected const DESCRIPTION = 'Delete a severity

Official FireHydrant endpoint: DELETE /v1/severities/{severity_slug}

Delete a specific severity';
    protected const PARAMETERS = array (
  'severity_slug' =>
  array (
    'type' => 'string',
    'description' => 'severity_slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

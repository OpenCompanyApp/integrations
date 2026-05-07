<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update severity matrix.
 *
 * Maps to the official FireHydrant endpoint patch /v1/severity_matrix.
 */
class FireHydrantUpdateSeverityMatrix extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_severity_matrix';
    protected const DESCRIPTION = 'Update severity matrix

Official FireHydrant endpoint: PATCH /v1/severity_matrix

Update available severities and impacts in your organization\'s severity matrix.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/severity_matrix';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

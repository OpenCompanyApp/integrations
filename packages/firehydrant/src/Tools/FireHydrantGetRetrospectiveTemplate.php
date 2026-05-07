<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a retrospective template.
 *
 * Maps to the official FireHydrant endpoint get /v1/retrospective_templates/{retrospective_template_id}.
 */
class FireHydrantGetRetrospectiveTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_retrospective_template';
    protected const DESCRIPTION = 'Get a retrospective template

Official FireHydrant endpoint: GET /v1/retrospective_templates/{retrospective_template_id}

Retrieve a single retrospective template by ID';
    protected const PARAMETERS = array (
  'retrospective_template_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_template_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_templates/{retrospective_template_id}';
    protected const PATH_PARAMS = array (
  'retrospective_template_id' => 'retrospective_template_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

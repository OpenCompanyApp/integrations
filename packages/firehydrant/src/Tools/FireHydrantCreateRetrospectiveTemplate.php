<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a retrospective template.
 *
 * Maps to the official FireHydrant endpoint post /v1/retrospective_templates.
 */
class FireHydrantCreateRetrospectiveTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_retrospective_template';
    protected const DESCRIPTION = 'Create a retrospective template

Official FireHydrant endpoint: POST /v1/retrospective_templates

Create a new retrospective template';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/retrospective_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a retrospective template.
 *
 * Maps to the official FireHydrant endpoint patch /v1/retrospective_templates/{retrospective_template_id}.
 */
class FireHydrantUpdateRetrospectiveTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_retrospective_template';
    protected const DESCRIPTION = 'Update a retrospective template

Official FireHydrant endpoint: PATCH /v1/retrospective_templates/{retrospective_template_id}

Update a single retrospective template';
    protected const PARAMETERS = array (
  'retrospective_template_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_template_id parameter.',
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
    protected const PATH = '/v1/retrospective_templates/{retrospective_template_id}';
    protected const PATH_PARAMS = array (
  'retrospective_template_id' => 'retrospective_template_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

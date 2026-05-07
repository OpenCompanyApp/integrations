<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a checklist template.
 *
 * Maps to the official FireHydrant endpoint patch /v1/checklist_templates/{id}.
 */
class FireHydrantUpdateChecklistTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_checklist_template';
    protected const DESCRIPTION = 'Update a checklist template

Official FireHydrant endpoint: PATCH /v1/checklist_templates/{id}

Update a checklist templates attributes';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
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
    protected const PATH = '/v1/checklist_templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

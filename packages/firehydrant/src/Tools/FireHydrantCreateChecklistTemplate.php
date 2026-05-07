<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a checklist template.
 *
 * Maps to the official FireHydrant endpoint post /v1/checklist_templates.
 */
class FireHydrantCreateChecklistTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_checklist_template';
    protected const DESCRIPTION = 'Create a checklist template

Official FireHydrant endpoint: POST /v1/checklist_templates

Creates a checklist template for the organization';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/checklist_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

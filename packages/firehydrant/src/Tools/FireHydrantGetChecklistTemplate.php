<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a checklist template.
 *
 * Maps to the official FireHydrant endpoint get /v1/checklist_templates/{id}.
 */
class FireHydrantGetChecklistTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_checklist_template';
    protected const DESCRIPTION = 'Get a checklist template

Official FireHydrant endpoint: GET /v1/checklist_templates/{id}

Retrieves a single checklist template by ID';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/checklist_templates/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

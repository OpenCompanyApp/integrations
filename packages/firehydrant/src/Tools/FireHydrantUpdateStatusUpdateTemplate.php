<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a status update template.
 *
 * Maps to the official FireHydrant endpoint patch /v1/status_update_templates/{status_update_template_id}.
 */
class FireHydrantUpdateStatusUpdateTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_status_update_template';
    protected const DESCRIPTION = 'Update a status update template

Official FireHydrant endpoint: PATCH /v1/status_update_templates/{status_update_template_id}

Update a single status update template';
    protected const PARAMETERS = array (
  'status_update_template_id' =>
  array (
    'type' => 'string',
    'description' => 'status_update_template_id parameter.',
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
    protected const PATH = '/v1/status_update_templates/{status_update_template_id}';
    protected const PATH_PARAMS = array (
  'status_update_template_id' => 'status_update_template_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

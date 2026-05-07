<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a status update template.
 *
 * Maps to the official FireHydrant endpoint get /v1/status_update_templates/{status_update_template_id}.
 */
class FireHydrantGetStatusUpdateTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_status_update_template';
    protected const DESCRIPTION = 'Get a status update template

Official FireHydrant endpoint: GET /v1/status_update_templates/{status_update_template_id}

Get a single status update template by ID';
    protected const PARAMETERS = array (
  'status_update_template_id' =>
  array (
    'type' => 'string',
    'description' => 'status_update_template_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/status_update_templates/{status_update_template_id}';
    protected const PATH_PARAMS = array (
  'status_update_template_id' => 'status_update_template_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

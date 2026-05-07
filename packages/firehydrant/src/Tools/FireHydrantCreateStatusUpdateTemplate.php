<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a status update template.
 *
 * Maps to the official FireHydrant endpoint post /v1/status_update_templates.
 */
class FireHydrantCreateStatusUpdateTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_status_update_template';
    protected const DESCRIPTION = 'Create a status update template

Official FireHydrant endpoint: POST /v1/status_update_templates

Create a status update template for your organization';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/status_update_templates';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

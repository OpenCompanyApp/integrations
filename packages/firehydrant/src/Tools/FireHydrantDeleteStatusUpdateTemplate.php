<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a status update template.
 *
 * Maps to the official FireHydrant endpoint delete /v1/status_update_templates/{status_update_template_id}.
 */
class FireHydrantDeleteStatusUpdateTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_status_update_template';
    protected const DESCRIPTION = 'Delete a status update template

Official FireHydrant endpoint: DELETE /v1/status_update_templates/{status_update_template_id}

Delete a single status update template';
    protected const PARAMETERS = array (
  'status_update_template_id' =>
  array (
    'type' => 'string',
    'description' => 'status_update_template_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a retrospective template.
 *
 * Maps to the official FireHydrant endpoint delete /v1/retrospective_templates/{retrospective_template_id}.
 */
class FireHydrantDeleteRetrospectiveTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_retrospective_template';
    protected const DESCRIPTION = 'Delete a retrospective template

Official FireHydrant endpoint: DELETE /v1/retrospective_templates/{retrospective_template_id}

Delete a single retrospective template';
    protected const PARAMETERS = array (
  'retrospective_template_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_template_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive a checklist template.
 *
 * Maps to the official FireHydrant endpoint delete /v1/checklist_templates/{id}.
 */
class FireHydrantDeleteChecklistTemplate extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_checklist_template';
    protected const DESCRIPTION = 'Archive a checklist template

Official FireHydrant endpoint: DELETE /v1/checklist_templates/{id}

Archive a checklist template';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Checklist Template UUID',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

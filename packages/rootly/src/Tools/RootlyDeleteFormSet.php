<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Delete a Form Set.
 *
 * Maps to the official Rootly endpoint delete /v1/form_sets/{id}.
 */
class RootlyDeleteFormSet extends AbstractRootlyTool
{
    protected const NAME = 'rootly_delete_form_set';
    protected const DESCRIPTION = 'Delete a Form Set

Official Rootly endpoint: DELETE /v1/form_sets/{id}

Delete a specific form_set by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/form_sets/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a Form Set.
 *
 * Maps to the official Rootly endpoint get /v1/form_sets/{id}.
 */
class RootlyGetFormSet extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_form_set';
    protected const DESCRIPTION = 'Retrieves a Form Set

Official Rootly endpoint: GET /v1/form_sets/{id}

Retrieves a specific form_set by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

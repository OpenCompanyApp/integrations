<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a form configuration.
 *
 * Maps to the official FireHydrant endpoint get /v1/form_configurations/{slug}.
 */
class FireHydrantGetFormConfiguration extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_form_configuration';
    protected const DESCRIPTION = 'Get a form configuration

Official FireHydrant endpoint: GET /v1/form_configurations/{slug}

Get a form configuration';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'description' => 'slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/form_configurations/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

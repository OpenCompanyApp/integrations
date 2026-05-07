<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Archive an environment.
 *
 * Maps to the official FireHydrant endpoint delete /v1/environments/{environment_id}.
 */
class FireHydrantDeleteEnvironment extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_environment';
    protected const DESCRIPTION = 'Archive an environment

Official FireHydrant endpoint: DELETE /v1/environments/{environment_id}

Archive an environment';
    protected const PARAMETERS = array (
  'environment_id' =>
  array (
    'type' => 'string',
    'description' => 'Environment UUID or slug',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/environments/{environment_id}';
    protected const PATH_PARAMS = array (
  'environment_id' => 'environment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

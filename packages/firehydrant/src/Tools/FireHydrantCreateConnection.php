<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a new integration connection.
 *
 * Maps to the official FireHydrant endpoint post /v1/integrations/connections/{slug}.
 */
class FireHydrantCreateConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_connection';
    protected const DESCRIPTION = 'Create a new integration connection

Official FireHydrant endpoint: POST /v1/integrations/connections/{slug}

Create a new integration connection';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'description' => 'slug parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/integrations/connections/{slug}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

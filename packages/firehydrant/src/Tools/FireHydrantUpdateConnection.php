<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an integration connection.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/connections/{slug}/{connection_id}.
 */
class FireHydrantUpdateConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_connection';
    protected const DESCRIPTION = 'Update an integration connection

Official FireHydrant endpoint: PATCH /v1/integrations/connections/{slug}/{connection_id}

Update the integration connection with the provided data';
    protected const PARAMETERS = array (
  'slug' =>
  array (
    'type' => 'string',
    'description' => 'slug parameter.',
    'required' => true,
  ),
  'connection_id' =>
  array (
    'type' => 'string',
    'description' => 'connection_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/integrations/connections/{slug}/{connection_id}';
    protected const PATH_PARAMS = array (
  'slug' => 'slug',
  'connection_id' => 'connection_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

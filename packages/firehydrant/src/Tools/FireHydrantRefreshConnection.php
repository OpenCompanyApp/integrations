<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Refresh an integration connection.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/connections/{slug}/{connection_id}/refresh.
 */
class FireHydrantRefreshConnection extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_refresh_connection';
    protected const DESCRIPTION = 'Refresh an integration connection

Official FireHydrant endpoint: PATCH /v1/integrations/connections/{slug}/{connection_id}/refresh

Refresh the integration connection with the provided data';
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
    protected const PATH = '/v1/integrations/connections/{slug}/{connection_id}/refresh';
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

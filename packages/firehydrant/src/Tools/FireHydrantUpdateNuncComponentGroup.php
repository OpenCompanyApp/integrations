<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a status page component group.
 *
 * Maps to the official FireHydrant endpoint patch /v1/nunc_connections/{nunc_connection_id}/component_groups/{group_id}.
 */
class FireHydrantUpdateNuncComponentGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_nunc_component_group';
    protected const DESCRIPTION = 'Update a status page component group

Official FireHydrant endpoint: PATCH /v1/nunc_connections/{nunc_connection_id}/component_groups/{group_id}

Update a component group to be displayed on a FireHydrant status page';
    protected const PARAMETERS = array (
  'nunc_connection_id' =>
  array (
    'type' => 'string',
    'description' => 'nunc_connection_id parameter.',
    'required' => true,
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'description' => 'group_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/nunc_connections/{nunc_connection_id}/component_groups/{group_id}';
    protected const PATH_PARAMS = array (
  'nunc_connection_id' => 'nunc_connection_id',
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

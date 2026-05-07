<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a status page component group.
 *
 * Maps to the official FireHydrant endpoint delete /v1/nunc_connections/{nunc_connection_id}/component_groups/{group_id}.
 */
class FireHydrantDeleteNuncComponentGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_nunc_component_group';
    protected const DESCRIPTION = 'Delete a status page component group

Official FireHydrant endpoint: DELETE /v1/nunc_connections/{nunc_connection_id}/component_groups/{group_id}

Delete a component group displayed on a FireHydrant status page';
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
);
    protected const METHOD = 'delete';
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

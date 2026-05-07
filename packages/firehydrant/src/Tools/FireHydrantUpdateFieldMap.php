<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update field mapping.
 *
 * Maps to the official FireHydrant endpoint patch /v1/integrations/field_maps/{field_map_id}.
 */
class FireHydrantUpdateFieldMap extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_field_map';
    protected const DESCRIPTION = 'Update field mapping

Official FireHydrant endpoint: PATCH /v1/integrations/field_maps/{field_map_id}

Update field mapping';
    protected const PARAMETERS = array (
  'field_map_id' =>
  array (
    'type' => 'string',
    'description' => 'field_map_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/integrations/field_maps/{field_map_id}';
    protected const PATH_PARAMS = array (
  'field_map_id' => 'field_map_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Partially update a SCIM group.
 *
 * Maps to the official FireHydrant endpoint patch /v1/scim/v2/Groups/{id}.
 */
class FireHydrantPatchScimGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_patch_scim_group';
    protected const DESCRIPTION = 'Partially update a SCIM group

Official FireHydrant endpoint: PATCH /v1/scim/v2/Groups/{id}

SCIM endpoint to partially update a Team (Colloquial for Group in the SCIM protocol). Supports adding, removing, or replacing members using SCIM PATCH operations.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/scim/v2/Groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a SCIM group.
 *
 * Maps to the official FireHydrant endpoint delete /v1/scim/v2/Groups/{id}.
 */
class FireHydrantDeleteScimGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_scim_group';
    protected const DESCRIPTION = 'Delete a SCIM group

Official FireHydrant endpoint: DELETE /v1/scim/v2/Groups/{id}

SCIM endpoint to delete a Team (Colloquial for Group in the SCIM protocol).';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/scim/v2/Groups/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

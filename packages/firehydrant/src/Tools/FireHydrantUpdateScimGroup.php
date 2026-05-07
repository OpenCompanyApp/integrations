<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a SCIM group and assign members.
 *
 * Maps to the official FireHydrant endpoint put /v1/scim/v2/Groups/{id}.
 */
class FireHydrantUpdateScimGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_scim_group';
    protected const DESCRIPTION = 'Update a SCIM group and assign members

Official FireHydrant endpoint: PUT /v1/scim/v2/Groups/{id}

SCIM endpoint to update a Team (Colloquial for Group in the SCIM protocol). Any members defined in the payload will be assigned to the team with no defined role, any missing members will be removed from the team.';
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
    protected const METHOD = 'put';
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

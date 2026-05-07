<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a SCIM group and assign members.
 *
 * Maps to the official FireHydrant endpoint post /v1/scim/v2/Groups.
 */
class FireHydrantCreateScimGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_scim_group';
    protected const DESCRIPTION = 'Create a SCIM group and assign members

Official FireHydrant endpoint: POST /v1/scim/v2/Groups

SCIM endpoint to create a new Team (Colloquial for Group in the SCIM protocol). Any members defined in the payload will be assigned to the team with no defined role.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/scim/v2/Groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

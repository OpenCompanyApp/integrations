<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a SCIM group.
 *
 * Maps to the official FireHydrant endpoint get /v1/scim/v2/Groups/{id}.
 */
class FireHydrantGetScimGroup extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_scim_group';
    protected const DESCRIPTION = 'Get a SCIM group

Official FireHydrant endpoint: GET /v1/scim/v2/Groups/{id}

SCIM endpoint that lists a Team (Colloquial for Group in the SCIM protocol)';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

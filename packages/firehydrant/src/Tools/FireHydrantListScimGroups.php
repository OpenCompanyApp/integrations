<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List SCIM groups.
 *
 * Maps to the official FireHydrant endpoint get /v1/scim/v2/Groups.
 */
class FireHydrantListScimGroups extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_scim_groups';
    protected const DESCRIPTION = 'List SCIM groups

Official FireHydrant endpoint: GET /v1/scim/v2/Groups

SCIM endpoint that lists all Teams (Colloquial for Group in the SCIM protocol)';
    protected const PARAMETERS = array (
  'start_index' =>
  array (
    'type' => 'integer',
    'description' => 'startIndex parameter.',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'description' => 'count parameter.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'description' => 'This is a string used to query groups by displayName.
        Proper example syntax for this would be `?filter=displayName eq "My Team Name"`.
        Currently we only support the `eq` operator',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/scim/v2/Groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'startIndex' => 'start_index',
  'count' => 'count',
  'filter' => 'filter',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

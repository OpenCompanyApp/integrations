<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List identities for a change entry.
 *
 * Maps to the official FireHydrant endpoint get /v1/changes/{change_id}/identities.
 */
class FireHydrantListChangeIdentities extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_change_identities';
    protected const DESCRIPTION = 'List identities for a change entry

Official FireHydrant endpoint: GET /v1/changes/{change_id}/identities

Retrieve all identities for the change entry';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'change_id' =>
  array (
    'type' => 'string',
    'description' => 'change_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/changes/{change_id}/identities';
    protected const PATH_PARAMS = array (
  'change_id' => 'change_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create an identity for a change entry.
 *
 * Maps to the official FireHydrant endpoint post /v1/changes/{change_id}/identities.
 */
class FireHydrantCreateChangeIdentity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_change_identity';
    protected const DESCRIPTION = 'Create an identity for a change entry

Official FireHydrant endpoint: POST /v1/changes/{change_id}/identities

Create an identity for the change entry';
    protected const PARAMETERS = array (
  'change_id' =>
  array (
    'type' => 'string',
    'description' => 'change_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/changes/{change_id}/identities';
    protected const PATH_PARAMS = array (
  'change_id' => 'change_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

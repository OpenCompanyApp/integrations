<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update an identity for a change entry.
 *
 * Maps to the official FireHydrant endpoint patch /v1/changes/{change_id}/identities/{identity_id}.
 */
class FireHydrantUpdateChangeIdentity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_change_identity';
    protected const DESCRIPTION = 'Update an identity for a change entry

Official FireHydrant endpoint: PATCH /v1/changes/{change_id}/identities/{identity_id}

Update an identity for the change entry';
    protected const PARAMETERS = array (
  'identity_id' =>
  array (
    'type' => 'string',
    'description' => 'identity_id parameter.',
    'required' => true,
  ),
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
    protected const METHOD = 'patch';
    protected const PATH = '/v1/changes/{change_id}/identities/{identity_id}';
    protected const PATH_PARAMS = array (
  'identity_id' => 'identity_id',
  'change_id' => 'change_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

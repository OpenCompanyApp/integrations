<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete an identity from a change entry.
 *
 * Maps to the official FireHydrant endpoint delete /v1/changes/{change_id}/identities/{identity_id}.
 */
class FireHydrantDeleteChangeIdentity extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_change_identity';
    protected const DESCRIPTION = 'Delete an identity from a change entry

Official FireHydrant endpoint: DELETE /v1/changes/{change_id}/identities/{identity_id}

Delete an identity from the change entry';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/changes/{change_id}/identities/{identity_id}';
    protected const PATH_PARAMS = array (
  'identity_id' => 'identity_id',
  'change_id' => 'change_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

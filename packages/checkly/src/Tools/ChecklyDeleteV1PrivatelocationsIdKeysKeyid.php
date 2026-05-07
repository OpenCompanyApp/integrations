<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an api key from a private location..
 *
 * Maps to the official Checkly endpoint DELETE /v1/private-locations/{id}/keys/{keyId}.
 */
class ChecklyDeleteV1PrivatelocationsIdKeysKeyid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_privatelocations_id_keys_keyid';
    protected const DESCRIPTION = 'Permanently removes an api key from a private location.

Official Checkly endpoint: DELETE /v1/private-locations/{id}/keys/{keyId}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'key_id' => array (
        'type' => 'string',
        'description' => 'keyId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/private-locations/{id}/keys/{keyId}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
      'keyId' => 'key_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

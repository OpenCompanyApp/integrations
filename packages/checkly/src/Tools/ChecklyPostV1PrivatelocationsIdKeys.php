<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates an api key on the private location..
 *
 * Maps to the official Checkly endpoint POST /v1/private-locations/{id}/keys.
 */
class ChecklyPostV1PrivatelocationsIdKeys extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_privatelocations_id_keys';
    protected const DESCRIPTION = 'Creates an api key on the private location.

Official Checkly endpoint: POST /v1/private-locations/{id}/keys.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/private-locations/{id}/keys';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

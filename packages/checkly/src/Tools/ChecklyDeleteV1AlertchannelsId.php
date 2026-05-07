<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes an alert channel.
 *
 * Maps to the official Checkly endpoint DELETE /v1/alert-channels/{id}.
 */
class ChecklyDeleteV1AlertchannelsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_alertchannels_id';
    protected const DESCRIPTION = 'Permanently removes an alert channel

Official Checkly endpoint: DELETE /v1/alert-channels/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/alert-channels/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes a API or browser check and all its related status and results data..
 *
 * Maps to the official Checkly endpoint DELETE /v1/checks/{id}.
 */
class ChecklyDeleteV1ChecksId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_checks_id';
    protected const DESCRIPTION = 'Permanently removes a API or browser check and all its related status and results data.

Official Checkly endpoint: DELETE /v1/checks/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/checks/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

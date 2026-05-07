<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Permanently removes a snippet..
 *
 * Maps to the official Checkly endpoint DELETE /v1/snippets/{id}.
 */
class ChecklyDeleteV1SnippetsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_snippets_id';
    protected const DESCRIPTION = 'Permanently removes a snippet.

Official Checkly endpoint: DELETE /v1/snippets/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/snippets/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

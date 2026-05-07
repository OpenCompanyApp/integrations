<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Updates a snippet..
 *
 * Maps to the official Checkly endpoint PUT /v1/snippets/{id}.
 */
class ChecklyPutV1SnippetsId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_snippets_id';
    protected const DESCRIPTION = 'Updates a snippet.

Official Checkly endpoint: PUT /v1/snippets/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'integer',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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

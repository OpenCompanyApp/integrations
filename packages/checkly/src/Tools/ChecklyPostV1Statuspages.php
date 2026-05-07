<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Create a new status page with its related services and cards..
 *
 * Maps to the official Checkly endpoint POST /v1/status-pages.
 */
class ChecklyPostV1Statuspages extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_statuspages';
    protected const DESCRIPTION = 'Create a new status page with its related services and cards.

Official Checkly endpoint: POST /v1/status-pages.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/status-pages';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

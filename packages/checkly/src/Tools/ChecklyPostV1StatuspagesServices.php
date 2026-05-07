<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Create a service.
 *
 * Maps to the official Checkly endpoint POST /v1/status-pages/services.
 */
class ChecklyPostV1StatuspagesServices extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_statuspages_services';
    protected const DESCRIPTION = 'Create a service

Official Checkly endpoint: POST /v1/status-pages/services.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/status-pages/services';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

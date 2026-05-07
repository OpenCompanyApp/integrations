<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new dashboard. Will return a 409 when attempting to create a dashboard with a custom URL or custom domain that is already taken..
 *
 * Maps to the official Checkly endpoint POST /v1/dashboards.
 */
class ChecklyPostV1Dashboards extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_dashboards';
    protected const DESCRIPTION = 'Creates a new dashboard. Will return a 409 when attempting to create a dashboard with a custom URL or custom domain that is already taken.

Official Checkly endpoint: POST /v1/dashboards.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dashboards';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

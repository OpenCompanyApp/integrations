<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Creates a new incident..
 *
 * Maps to the official Checkly endpoint POST /v1/status-pages/incidents.
 */
class ChecklyPostV1StatuspagesIncidents extends AbstractChecklyTool
{
    protected const NAME = 'checkly_post_v1_statuspages_incidents';
    protected const DESCRIPTION = 'Creates a new incident.

Official Checkly endpoint: POST /v1/status-pages/incidents.';
    protected const PARAMETERS = array (
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'POST';
    protected const PATH = '/v1/status-pages/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

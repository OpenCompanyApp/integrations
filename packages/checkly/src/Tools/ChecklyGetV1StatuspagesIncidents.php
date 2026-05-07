<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get the latest 100 incidents for all services..
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/incidents.
 */
class ChecklyGetV1StatuspagesIncidents extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_incidents';
    protected const DESCRIPTION = 'Get the latest 100 incidents for all services.

Official Checkly endpoint: GET /v1/status-pages/incidents.';
    protected const PARAMETERS = array (
      'limit' => array (
        'type' => 'integer',
        'description' => 'limit parameter.',
        'required' => false,
      ),
      'next_id' => array (
        'type' => 'string',
        'description' => 'nextId parameter.',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/status-pages/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
      'limit' => 'limit',
      'nextId' => 'next_id',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

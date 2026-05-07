<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get a single service.
 *
 * Maps to the official Checkly endpoint GET /v1/status-pages/services/{serviceId}.
 */
class ChecklyGetV1StatuspagesServicesServiceid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_statuspages_services_serviceid';
    protected const DESCRIPTION = 'Get a single service

Official Checkly endpoint: GET /v1/status-pages/services/{serviceId}.';
    protected const PARAMETERS = array (
      'service_id' => array (
        'type' => 'string',
        'description' => 'serviceId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/status-pages/services/{serviceId}';
    protected const PATH_PARAMS = array (
      'serviceId' => 'service_id',
    );
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

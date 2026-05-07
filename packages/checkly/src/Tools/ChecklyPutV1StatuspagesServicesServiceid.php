<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Update a service.
 *
 * Maps to the official Checkly endpoint PUT /v1/status-pages/services/{serviceId}.
 */
class ChecklyPutV1StatuspagesServicesServiceid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_put_v1_statuspages_services_serviceid';
    protected const DESCRIPTION = 'Update a service

Official Checkly endpoint: PUT /v1/status-pages/services/{serviceId}.';
    protected const PARAMETERS = array (
      'service_id' => array (
        'type' => 'string',
        'description' => 'serviceId parameter.',
        'required' => true,
      ),
      'body' => array (
        'type' => 'object',
        'description' => 'JSON request body matching the Checkly API schema.',
        'required' => false,
      ),
    );
    protected const METHOD = 'PUT';
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

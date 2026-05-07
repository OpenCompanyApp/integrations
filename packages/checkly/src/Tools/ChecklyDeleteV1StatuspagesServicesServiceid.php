<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Delete a service.
 *
 * Maps to the official Checkly endpoint DELETE /v1/status-pages/services/{serviceId}.
 */
class ChecklyDeleteV1StatuspagesServicesServiceid extends AbstractChecklyTool
{
    protected const NAME = 'checkly_delete_v1_statuspages_services_serviceid';
    protected const DESCRIPTION = 'Delete a service

Official Checkly endpoint: DELETE /v1/status-pages/services/{serviceId}.';
    protected const PARAMETERS = array (
      'service_id' => array (
        'type' => 'string',
        'description' => 'serviceId parameter.',
        'required' => true,
      ),
    );
    protected const METHOD = 'DELETE';
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

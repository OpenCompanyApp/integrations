<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Get private location health metrics from a window of time. Rate-limiting is applied to this endpoint, you can send 300 requests per day at most..
 *
 * Maps to the official Checkly endpoint GET /v1/private-locations/{id}/metrics.
 */
class ChecklyGetV1PrivatelocationsIdMetrics extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_privatelocations_id_metrics';
    protected const DESCRIPTION = 'Get private location health metrics from a window of time. Rate-limiting is applied to this endpoint, you can send 300 requests per day at most.

Official Checkly endpoint: GET /v1/private-locations/{id}/metrics.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Select metrics beginning with this UNIX timestamp. Must be less than 15 days ago.',
        'required' => true,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Select metrics up to this UNIX timestamp.',
        'required' => true,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/private-locations/{id}/metrics';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'from' => 'from',
      'to' => 'to',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

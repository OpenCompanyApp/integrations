<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Hosted Flow > Get flow.
 *
 * Maps to the official Airwallex endpoint GET /api/v1/hosted_flows/{hosted_flow_instance_id}.
 */
class AirwallexScaleGetFlow extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_get_flow';
    protected const DESCRIPTION = 'Scale > Hosted Flow > Get flow.

Maps to the official Airwallex public Postman collection endpoint GET /api/v1/hosted_flows/{hosted_flow_instance_id}.';
    protected const PARAMETERS = [
        'hosted_flow_instance_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `hosted_flow_instance_id`.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/hosted_flows/{hosted_flow_instance_id}';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'hosted_flow_instance_id' => 'hosted_flow_instance_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

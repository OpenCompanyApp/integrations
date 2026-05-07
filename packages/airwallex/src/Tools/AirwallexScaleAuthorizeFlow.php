<?php

namespace OpenCompany\Integrations\Airwallex\Tools;

/**
 * Scale > Hosted Flow > Authorize flow.
 *
 * Maps to the official Airwallex endpoint POST /api/v1/hosted_flows/{hosted_flow_instance_id}/authorize.
 */
class AirwallexScaleAuthorizeFlow extends AbstractAirwallexTool
{
    protected const NAME = 'airwallex_scale_authorize_flow';
    protected const DESCRIPTION = 'Scale > Hosted Flow > Authorize flow.

Maps to the official Airwallex public Postman collection endpoint POST /api/v1/hosted_flows/{hosted_flow_instance_id}/authorize.';
    protected const PARAMETERS = [
        'hosted_flow_instance_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Path parameter `hosted_flow_instance_id`.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body fields matching the Airwallex API request example for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/hosted_flows/{hosted_flow_instance_id}/authorize';
    protected const BASE = 'api';
    protected const PATH_PARAMS = [
        'hosted_flow_instance_id' => 'hosted_flow_instance_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}

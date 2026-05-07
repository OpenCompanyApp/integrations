<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Endpoint Secret using the official Svix API.
 */
class SvixGetEndpointSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.get-secret';
}

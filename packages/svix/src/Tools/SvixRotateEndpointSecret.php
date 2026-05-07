<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Endpoint Secret using the official Svix API.
 */
class SvixRotateEndpointSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.rotate-secret';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Endpoint Headers using the official Svix API.
 */
class SvixGetEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.get-headers';
}

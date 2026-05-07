<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Endpoint Stats using the official Svix API.
 */
class SvixEndpointStats extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.get-stats';
}

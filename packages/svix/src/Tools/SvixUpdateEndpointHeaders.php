<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Endpoint Headers using the official Svix API.
 */
class SvixUpdateEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.update-headers';
}

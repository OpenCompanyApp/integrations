<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Endpoint Headers using the official Svix API.
 */
class SvixPatchEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.patch-headers';
}

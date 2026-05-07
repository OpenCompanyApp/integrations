<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Endpoint using the official Svix API.
 */
class SvixPatchEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.patch';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Endpoint Transformation using the official Svix API.
 */
class SvixPatchEndpointTransformation extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.patch-transformation';
}

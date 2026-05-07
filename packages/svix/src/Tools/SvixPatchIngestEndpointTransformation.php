<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Ingest Endpoint Transformation using the official Svix API.
 */
class SvixPatchIngestEndpointTransformation extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.set-transformation';
}

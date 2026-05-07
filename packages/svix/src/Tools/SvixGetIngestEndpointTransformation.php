<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Ingest Endpoint Transformation using the official Svix API.
 */
class SvixGetIngestEndpointTransformation extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.get-transformation';
}

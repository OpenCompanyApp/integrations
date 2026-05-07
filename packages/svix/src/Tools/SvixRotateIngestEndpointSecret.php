<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Ingest Endpoint Secret using the official Svix API.
 */
class SvixRotateIngestEndpointSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.rotate-secret';
}

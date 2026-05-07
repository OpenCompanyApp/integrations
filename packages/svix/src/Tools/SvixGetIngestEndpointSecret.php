<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Ingest Endpoint Secret using the official Svix API.
 */
class SvixGetIngestEndpointSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.get-secret';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Ingest Endpoint Headers using the official Svix API.
 */
class SvixGetIngestEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.get-headers';
}

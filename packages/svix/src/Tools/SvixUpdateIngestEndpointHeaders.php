<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Ingest Endpoint Headers using the official Svix API.
 */
class SvixUpdateIngestEndpointHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.update-headers';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Ingest Endpoint using the official Svix API.
 */
class SvixGetIngestEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.get';
}

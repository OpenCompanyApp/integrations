<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Ingest Endpoint using the official Svix API.
 */
class SvixCreateIngestEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.create';
}

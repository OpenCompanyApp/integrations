<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Ingest Endpoint using the official Svix API.
 */
class SvixUpdateIngestEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.update';
}

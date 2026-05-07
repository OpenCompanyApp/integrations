<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Ingest Endpoint using the official Svix API.
 */
class SvixDeleteIngestEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.delete';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Ingest Endpoints using the official Svix API.
 */
class SvixListIngestEndpoints extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.endpoint.list';
}

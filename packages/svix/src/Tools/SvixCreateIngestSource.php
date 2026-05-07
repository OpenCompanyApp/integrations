<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Ingest Source using the official Svix API.
 */
class SvixCreateIngestSource extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.source.create';
}

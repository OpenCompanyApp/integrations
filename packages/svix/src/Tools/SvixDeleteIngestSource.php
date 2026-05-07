<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Ingest Source using the official Svix API.
 */
class SvixDeleteIngestSource extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.source.delete';
}

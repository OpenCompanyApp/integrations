<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Ingest Sources using the official Svix API.
 */
class SvixListIngestSources extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.source.list';
}

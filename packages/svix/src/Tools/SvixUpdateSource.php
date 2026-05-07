<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Source using the official Svix API.
 */
class SvixUpdateSource extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.source.update';
}

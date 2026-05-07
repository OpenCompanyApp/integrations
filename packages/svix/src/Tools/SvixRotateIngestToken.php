<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Ingest Token using the official Svix API.
 */
class SvixRotateIngestToken extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.ingest.source.rotate-token';
}

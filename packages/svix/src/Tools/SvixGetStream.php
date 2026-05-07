<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Stream using the official Svix API.
 */
class SvixGetStream extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.stream.get';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Sink Headers using the official Svix API.
 */
class SvixGetSinkHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink-headers-get';
}

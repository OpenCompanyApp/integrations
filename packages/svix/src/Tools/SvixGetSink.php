<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Sink using the official Svix API.
 */
class SvixGetSink extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.get';
}

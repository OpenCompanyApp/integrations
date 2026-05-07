<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Sink Secret using the official Svix API.
 */
class SvixGetSinkSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.get-secret';
}

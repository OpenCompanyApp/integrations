<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Sink Secret using the official Svix API.
 */
class SvixRotateSinkSecret extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.rotate-secret';
}

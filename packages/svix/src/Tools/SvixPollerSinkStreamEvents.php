<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Poller Sink Stream Events using the official Svix API.
 */
class SvixPollerSinkStreamEvents extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.events.get';
}

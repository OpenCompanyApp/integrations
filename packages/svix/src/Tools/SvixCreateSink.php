<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Sink using the official Svix API.
 */
class SvixCreateSink extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.create';
}

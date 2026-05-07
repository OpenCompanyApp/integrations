<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Sink using the official Svix API.
 */
class SvixUpdateSink extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.update';
}

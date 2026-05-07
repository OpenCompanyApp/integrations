<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Sink using the official Svix API.
 */
class SvixDeleteSink extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.delete';
}

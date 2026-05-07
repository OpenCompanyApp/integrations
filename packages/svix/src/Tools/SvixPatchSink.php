<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Sink using the official Svix API.
 */
class SvixPatchSink extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink.patch';
}

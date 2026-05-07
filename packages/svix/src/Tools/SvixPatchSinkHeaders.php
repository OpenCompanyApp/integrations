<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Sink Headers using the official Svix API.
 */
class SvixPatchSinkHeaders extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.sink-headers-patch';
}

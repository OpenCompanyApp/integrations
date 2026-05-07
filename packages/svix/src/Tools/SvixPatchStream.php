<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Patch Stream using the official Svix API.
 */
class SvixPatchStream extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.stream.patch';
}

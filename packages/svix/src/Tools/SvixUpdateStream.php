<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Update Stream using the official Svix API.
 */
class SvixUpdateStream extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.stream.update';
}

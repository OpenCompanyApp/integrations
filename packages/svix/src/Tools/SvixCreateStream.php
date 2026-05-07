<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Stream using the official Svix API.
 */
class SvixCreateStream extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.stream.create';
}

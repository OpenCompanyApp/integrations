<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Rotate Poller Token using the official Svix API.
 */
class SvixRotatePollerToken extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.rotate-stream-poller-token';
}

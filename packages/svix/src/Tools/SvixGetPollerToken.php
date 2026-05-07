<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Poller Token using the official Svix API.
 */
class SvixGetPollerToken extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.get-stream-poller-token';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Replay Missing Webhooks using the official Svix API.
 */
class SvixReplayMissingWebhooks extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.endpoint.replay-missing';
}

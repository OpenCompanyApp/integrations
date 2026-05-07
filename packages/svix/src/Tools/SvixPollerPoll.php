<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Poller Poll using the official Svix API.
 */
class SvixPollerPoll extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.poller.poll';
}

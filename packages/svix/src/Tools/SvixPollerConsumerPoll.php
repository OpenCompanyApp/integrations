<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Poller Consumer Poll using the official Svix API.
 */
class SvixPollerConsumerPoll extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.poller.consumer-poll';
}

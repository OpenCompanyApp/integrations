<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Poller Consumer Seek using the official Svix API.
 */
class SvixPollerConsumerSeek extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.poller.consumer-seek';
}

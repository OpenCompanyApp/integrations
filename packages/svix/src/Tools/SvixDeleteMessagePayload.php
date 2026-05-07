<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete message payload using the official Svix API.
 */
class SvixDeleteMessagePayload extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.expunge-content';
}

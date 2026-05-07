<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Events using the official Svix API.
 */
class SvixCreateEvents extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.events.create';
}

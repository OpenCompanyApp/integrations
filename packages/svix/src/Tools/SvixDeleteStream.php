<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete Stream using the official Svix API.
 */
class SvixDeleteStream extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.streaming.stream.delete';
}

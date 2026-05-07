<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Message using the official Svix API.
 */
class SvixGetMessage extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.get';
}

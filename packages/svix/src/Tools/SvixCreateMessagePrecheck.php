<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Message Precheck using the official Svix API.
 */
class SvixCreateMessagePrecheck extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.precheck';
}

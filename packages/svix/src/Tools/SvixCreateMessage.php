<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Create Message using the official Svix API.
 */
class SvixCreateMessage extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.create';
}

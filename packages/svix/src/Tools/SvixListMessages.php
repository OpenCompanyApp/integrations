<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Messages using the official Svix API.
 */
class SvixListMessages extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message.list';
}

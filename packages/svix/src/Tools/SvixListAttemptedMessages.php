<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Attempted Messages using the official Svix API.
 */
class SvixListAttemptedMessages extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.list-attempted-messages';
}

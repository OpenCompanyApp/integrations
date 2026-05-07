<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Get Attempt using the official Svix API.
 */
class SvixGetAttempt extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.get';
}

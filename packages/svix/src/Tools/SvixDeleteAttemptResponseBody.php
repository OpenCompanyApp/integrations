<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Delete attempt response body using the official Svix API.
 */
class SvixDeleteAttemptResponseBody extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.expunge-content';
}

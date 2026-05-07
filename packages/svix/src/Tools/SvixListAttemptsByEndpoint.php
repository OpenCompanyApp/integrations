<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Attempts By Endpoint using the official Svix API.
 */
class SvixListAttemptsByEndpoint extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.list-by-endpoint';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Attempts By Msg using the official Svix API.
 */
class SvixListAttemptsByMsg extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.list-by-msg';
}

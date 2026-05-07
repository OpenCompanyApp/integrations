<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * List Attempted Destinations using the official Svix API.
 */
class SvixListAttemptedDestinations extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.message-attempt.list-attempted-destinations';
}

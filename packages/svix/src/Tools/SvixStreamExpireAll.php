<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Stream Expire All using the official Svix API.
 */
class SvixStreamExpireAll extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.stream-expire-all';
}

<?php

namespace OpenCompany\Integrations\Svix\Tools;

/**
 * Expire All using the official Svix API.
 */
class SvixExpireAll extends AbstractSvixOperationTool
{
    protected const OPERATION = 'v1.authentication.expire-all';
}

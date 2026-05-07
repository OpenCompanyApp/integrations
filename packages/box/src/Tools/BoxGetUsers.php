<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List enterprise users.
 *
 * Executes the official Box API operation get_users.
 */
class BoxGetUsers extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_users';
}

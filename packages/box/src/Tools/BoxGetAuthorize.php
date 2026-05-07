<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Authorize user.
 *
 * Executes the official Box API operation get_authorize.
 */
class BoxGetAuthorize extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_authorize';
}

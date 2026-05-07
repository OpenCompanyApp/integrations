<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List Box Sign requests.
 *
 * Executes the official Box API operation get_sign_requests.
 */
class BoxGetSignRequests extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_sign_requests';
}

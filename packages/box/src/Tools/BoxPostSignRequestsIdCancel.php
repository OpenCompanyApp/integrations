<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Cancel Box Sign request.
 *
 * Executes the official Box API operation post_sign_requests_id_cancel.
 */
class BoxPostSignRequestsIdCancel extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_sign_requests_id_cancel';
}

<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Resend Box Sign request.
 *
 * Executes the official Box API operation post_sign_requests_id_resend.
 */
class BoxPostSignRequestsIdResend extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_sign_requests_id_resend';
}

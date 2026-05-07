<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Update terms of service status for existing user.
 *
 * Executes the official Box API operation put_terms_of_service_user_statuses_id.
 */
class BoxPutTermsOfServiceUserStatusesId extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_put_terms_of_service_user_statuses_id';
}

<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Copy file request.
 *
 * Executes the official Box API operation post_file_requests_id_copy.
 */
class BoxPostFileRequestsIdCopy extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_file_requests_id_copy';
}

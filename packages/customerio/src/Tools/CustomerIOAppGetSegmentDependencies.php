<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * Use this endpoint to find out which campaigns and newsletters use a segment.
 */
class CustomerIOAppGetSegmentDependencies extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_app_get_segment_dependencies';
}

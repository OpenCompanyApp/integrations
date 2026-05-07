<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * The batch method helps you send an array of identify, group, track, page and/or screen requests in a single call, so you don't have to send multiple requests.
 */
class CustomerIOPipelinesBatch extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_pipelines_batch';
}

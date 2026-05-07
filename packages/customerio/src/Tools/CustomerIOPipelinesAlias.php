<?php

namespace OpenCompany\Integrations\CustomerIO\Tools;

/**
 * *You **only** need to use this method to support a few select destinations like Mixpanel.* The alias method reconciles identifiers in systems that don't automatically handle identity changeslike when a person graduates f.
 */
class CustomerIOPipelinesAlias extends AbstractCustomerIOOperationTool
{
    protected const OPERATION = 'customerio_pipelines_alias';
}

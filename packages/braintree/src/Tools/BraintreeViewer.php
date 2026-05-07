<?php

namespace OpenCompany\Integrations\Braintree\Tools;

/**
 * Viewer.
 *
 * Executes the official Braintree GraphQL field viewer.
 */
class BraintreeViewer extends AbstractBraintreeOperationTool
{
    protected const OPERATION = 'braintree_viewer';
}

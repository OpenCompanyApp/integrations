<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Webhook Edit tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutWebhookEdit extends AbstractVboutOperationTool
{
    protected const OPERATION = 'webhook_edit';
}